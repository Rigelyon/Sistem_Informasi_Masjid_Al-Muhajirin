import AuthenticatedLayout from "@/layouts/authenticated-layout";
import { Head, Link, router } from "@inertiajs/react";
import { PageProps } from "@/types";
import { Button } from "@/components/ui/button";
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from "@/components/ui/table";
import { Plus, Pencil, Trash2 } from "lucide-react";
import { toast } from "sonner";

interface Program {
    id: number;
    emoji: string | null;
    title: string;
    description: string;
    schedule_type: string;
}

interface Props extends PageProps {
    programs: Program[];
}

export default function ProgramIndex({ auth, programs }: Props) {
    const handleDelete = (id: number) => {
        if (confirm("Apakah Anda yakin ingin menghapus program ini?")) {
            router.delete(route("programs.destroy", id), {
                onSuccess: () => toast.success("Program berhasil dihapus"),
                onError: () => toast.error("Gagal menghapus program"),
            });
        }
    };

    return (
        <AuthenticatedLayout
            header={
                <div className="flex justify-between items-center">
                    <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                        Program & Aktivitas
                    </h2>
                    <Button asChild>
                        <Link href={route("programs.create")}>
                            <Plus className="w-4 h-4 mr-2" />
                            Tambah Program
                        </Link>
                    </Button>
                </div>
            }
        >
            <Head title="Program & Aktivitas" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <Table>
                            <TableHeader>
                                <TableRow>
                                    <TableHead className="w-[50px]">Emoji</TableHead>
                                    <TableHead>Judul</TableHead>
                                    <TableHead>Deskripsi</TableHead>
                                    <TableHead>Tipe Jadwal</TableHead>
                                    <TableHead className="text-right">Aksi</TableHead>
                                </TableRow>
                            </TableHeader>
                            <TableBody>
                                {programs.length === 0 ? (
                                    <TableRow>
                                        <TableCell
                                            colSpan={5}
                                            className="text-center py-10 text-gray-500"
                                        >
                                            Belum ada program yang ditambahkan.
                                        </TableCell>
                                    </TableRow>
                                ) : (
                                    programs.map((program) => (
                                        <TableRow key={program.id}>
                                            <TableCell className="text-2xl">
                                                {program.emoji || "📝"}
                                            </TableCell>
                                            <TableCell className="font-medium">
                                                {program.title}
                                            </TableCell>
                                            <TableCell className="max-w-md truncate">
                                                {program.description}
                                            </TableCell>
                                            <TableCell>
                                                <span className="capitalize">
                                                    {program.schedule_type.replace(
                                                        "_",
                                                        " "
                                                    )}
                                                </span>
                                            </TableCell>
                                            <TableCell className="text-right space-x-2">
                                                <Button
                                                    variant="outline"
                                                    size="icon"
                                                    asChild
                                                >
                                                    <Link
                                                        href={route(
                                                            "programs.edit",
                                                            program.id
                                                        )}
                                                    >
                                                        <Pencil className="w-4 h-4" />
                                                    </Link>
                                                </Button>
                                                <Button
                                                    variant="destructive"
                                                    size="icon"
                                                    onClick={() =>
                                                        handleDelete(program.id)
                                                    }
                                                >
                                                    <Trash2 className="w-4 h-4" />
                                                </Button>
                                            </TableCell>
                                        </TableRow>
                                    ))
                                )}
                            </TableBody>
                        </Table>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
