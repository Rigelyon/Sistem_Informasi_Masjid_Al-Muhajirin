import AuthenticatedLayout from "@/layouts/authenticated-layout";
import { Head, useForm, router } from "@inertiajs/react";
import { Button } from "@/components/ui/button";
import { Card, CardContent, CardFooter, CardHeader, CardTitle } from "@/components/ui/card";
import { Dialog, DialogContent, DialogHeader, DialogTitle, DialogTrigger, DialogFooter } from "@/components/ui/dialog";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { Textarea } from "@/components/ui/textarea";
import { Plus, Trash2, Edit, Image as ImageIcon, X } from "lucide-react";
import { useState } from "react";

interface GalleryPhoto {
    id: number;
    image_path: string;
    caption: string;
}

interface GalleryGroup {
    id: number;
    title: string;
    description: string;
    photos: GalleryPhoto[];
}

export default function GalleryIndex({ groups }: { groups: GalleryGroup[] }) {
    const [isCreateOpen, setIsCreateOpen] = useState(false);
    const [editingGroup, setEditingGroup] = useState<GalleryGroup | null>(null);
    const [managingGroup, setManagingGroup] = useState<GalleryGroup | null>(null);

    const { data, setData, post, processing, reset, errors, clearErrors } = useForm({
        title: "",
        description: "",
    });

    const { data: photoData, setData: setPhotoData, post: postPhoto, processing: photoProcessing, reset: resetPhoto, errors: photoErrors, clearErrors: clearPhotoErrors } = useForm({
        gallery_group_id: "",
        image: null as File | null,
        caption: "",
    });

    const submitCreate = (e: React.FormEvent) => {
        e.preventDefault();
        post(route("gallery.group.store"), {
            onSuccess: () => {
                setIsCreateOpen(false);
                reset();
            },
        });
    };

    const submitUpdate = (e: React.FormEvent) => {
        e.preventDefault();
        if (!editingGroup) return;
        router.patch(route("gallery.group.update", editingGroup.id), data, {
            onSuccess: () => {
                setEditingGroup(null);
                reset();
            },
        });
    };

    const deleteGroup = (id: number) => {
        if (confirm("Apakah Anda yakin ingin menghapus grup ini beserta semua fotonya?")) {
            router.delete(route("gallery.group.destroy", id));
        }
    };

    const submitPhoto = (e: React.FormEvent) => {
        e.preventDefault();
        if (!managingGroup) return;
        
        postPhoto(route("gallery.photo.store"), {
            onSuccess: () => {
                resetPhoto();
                // Refresh managing group data locally or rely on props update
                // Since props update, managingGroup needs to be updated or we just close and reopen?
                // Better to find the updated group from props, but props are not available inside this closure directly updated.
                // We can close the dialog or just let Inertia reload.
                // To keep the dialog open and updated, we need to sync managingGroup with the new props.
                // For now, let's just reset.
                setPhotoData("gallery_group_id", managingGroup.id.toString());
            },
        });
    };

    const deletePhoto = (id: number) => {
        if (confirm("Hapus foto ini?")) {
            router.delete(route("gallery.photo.destroy", id));
        }
    };

    // Sync managingGroup with props when props change
    const activeGroup = groups.find(g => g.id === managingGroup?.id);

    return (
        <AuthenticatedLayout header="Kelola Galeri">
            <Head title="Kelola Galeri" />

            <div className="p-6">
                <div className="flex justify-between items-center mb-6">
                    <h2 className="text-2xl font-bold">Daftar Galeri</h2>
                    <Button onClick={() => setIsCreateOpen(true)} disabled={groups.length >= 12}>
                        <Plus className="mr-2 h-4 w-4" /> Tambah Grup
                    </Button>
                </div>

                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    {groups.map((group) => (
                        <Card key={group.id} className="flex flex-col">
                            <CardHeader>
                                <CardTitle className="flex justify-between items-start">
                                    <span className="truncate">{group.title}</span>
                                    <div className="flex gap-2">
                                        <Button variant="ghost" size="icon" onClick={() => {
                                            setData({ title: group.title, description: group.description || "" });
                                            setEditingGroup(group);
                                        }}>
                                            <Edit className="h-4 w-4" />
                                        </Button>
                                        <Button variant="ghost" size="icon" className="text-red-500 hover:text-red-700" onClick={() => deleteGroup(group.id)}>
                                            <Trash2 className="h-4 w-4" />
                                        </Button>
                                    </div>
                                </CardTitle>
                            </CardHeader>
                            <CardContent className="flex-grow">
                                <p className="text-sm text-gray-500 mb-4 line-clamp-2">{group.description}</p>
                                <div className="grid grid-cols-3 gap-2">
                                    {group.photos.slice(0, 3).map((photo) => (
                                        <div key={photo.id} className="aspect-square rounded-md overflow-hidden bg-gray-100">
                                            <img src={`/storage/${photo.image_path}`} alt={photo.caption} className="w-full h-full object-cover" />
                                        </div>
                                    ))}
                                    {group.photos.length > 3 && (
                                        <div className="aspect-square rounded-md bg-gray-100 flex items-center justify-center text-gray-500 text-xs">
                                            +{group.photos.length - 3}
                                        </div>
                                    )}
                                </div>
                            </CardContent>
                            <CardFooter>
                                <Button variant="outline" className="w-full" onClick={() => {
                                    setManagingGroup(group);
                                    setPhotoData("gallery_group_id", group.id.toString());
                                }}>
                                    <ImageIcon className="mr-2 h-4 w-4" /> Kelola Foto ({group.photos.length}/5)
                                </Button>
                            </CardFooter>
                        </Card>
                    ))}
                </div>

                {/* Create Group Dialog */}
                <Dialog open={isCreateOpen} onOpenChange={setIsCreateOpen}>
                    <DialogContent>
                        <DialogHeader>
                            <DialogTitle>Buat Grup Galeri Baru</DialogTitle>
                        </DialogHeader>
                        <form onSubmit={submitCreate} className="space-y-4">
                            <div>
                                <Label htmlFor="title">Judul</Label>
                                <Input id="title" value={data.title} onChange={e => setData("title", e.target.value)} required />
                                {errors.title && <p className="text-red-500 text-sm">{errors.title}</p>}
                            </div>
                            <div>
                                <Label htmlFor="description">Deskripsi</Label>
                                <Textarea id="description" value={data.description} onChange={e => setData("description", e.target.value)} />
                                {errors.description && <p className="text-red-500 text-sm">{errors.description}</p>}
                            </div>
                            <DialogFooter>
                                <Button type="submit" disabled={processing}>Simpan</Button>
                            </DialogFooter>
                        </form>
                    </DialogContent>
                </Dialog>

                {/* Edit Group Dialog */}
                <Dialog open={!!editingGroup} onOpenChange={(open) => !open && setEditingGroup(null)}>
                    <DialogContent>
                        <DialogHeader>
                            <DialogTitle>Edit Grup Galeri</DialogTitle>
                        </DialogHeader>
                        <form onSubmit={submitUpdate} className="space-y-4">
                            <div>
                                <Label htmlFor="edit-title">Judul</Label>
                                <Input id="edit-title" value={data.title} onChange={e => setData("title", e.target.value)} required />
                                {errors.title && <p className="text-red-500 text-sm">{errors.title}</p>}
                            </div>
                            <div>
                                <Label htmlFor="edit-description">Deskripsi</Label>
                                <Textarea id="edit-description" value={data.description} onChange={e => setData("description", e.target.value)} />
                                {errors.description && <p className="text-red-500 text-sm">{errors.description}</p>}
                            </div>
                            <DialogFooter>
                                <Button type="submit" disabled={processing}>Update</Button>
                            </DialogFooter>
                        </form>
                    </DialogContent>
                </Dialog>

                {/* Manage Photos Dialog */}
                <Dialog open={!!managingGroup} onOpenChange={(open) => !open && setManagingGroup(null)}>
                    <DialogContent className="max-w-3xl">
                        <DialogHeader>
                            <DialogTitle>Kelola Foto - {managingGroup?.title}</DialogTitle>
                        </DialogHeader>
                        
                        <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {/* Add Photo Form */}
                            <div className="space-y-4">
                                <h3 className="font-semibold">Tambah Foto</h3>
                                {activeGroup && activeGroup.photos.length >= 5 ? (
                                    <div className="p-3 bg-yellow-100 text-yellow-800 rounded-md text-sm">
                                        Grup ini sudah mencapai batas maksimal 5 foto.
                                    </div>
                                ) : (
                                    <form onSubmit={submitPhoto} className="space-y-4">
                                        <div>
                                            <Label htmlFor="image">Foto</Label>
                                            <Input id="image" type="file" accept="image/*" onChange={e => setPhotoData("image", e.target.files ? e.target.files[0] : null)} required />
                                            {photoErrors.image && <p className="text-red-500 text-sm">{photoErrors.image}</p>}
                                        </div>
                                        <div>
                                            <Label htmlFor="caption">Caption</Label>
                                            <Input id="caption" value={photoData.caption} onChange={e => setPhotoData("caption", e.target.value)} />
                                            {photoErrors.caption && <p className="text-red-500 text-sm">{photoErrors.caption}</p>}
                                        </div>
                                        <Button type="submit" disabled={photoProcessing}>Upload</Button>
                                    </form>
                                )}
                            </div>

                            {/* Photo List */}
                            <div className="space-y-4">
                                <h3 className="font-semibold">Daftar Foto ({activeGroup?.photos.length || 0}/5)</h3>
                                <div className="space-y-2 max-h-[400px] overflow-y-auto">
                                    {activeGroup?.photos.map((photo) => (
                                        <div key={photo.id} className="flex items-center gap-3 p-2 border rounded-md">
                                            <div className="h-16 w-16 flex-shrink-0 bg-gray-100 rounded overflow-hidden">
                                                <img src={`/storage/${photo.image_path}`} alt={photo.caption} className="w-full h-full object-cover" />
                                            </div>
                                            <div className="flex-grow min-w-0">
                                                <p className="text-sm truncate">{photo.caption || "Tanpa caption"}</p>
                                            </div>
                                            <Button variant="ghost" size="icon" className="text-red-500" onClick={() => deletePhoto(photo.id)}>
                                                <Trash2 className="h-4 w-4" />
                                            </Button>
                                        </div>
                                    ))}
                                    {activeGroup?.photos.length === 0 && (
                                        <p className="text-sm text-gray-500 italic">Belum ada foto.</p>
                                    )}
                                </div>
                            </div>
                        </div>
                    </DialogContent>
                </Dialog>
            </div>
        </AuthenticatedLayout>
    );
}
