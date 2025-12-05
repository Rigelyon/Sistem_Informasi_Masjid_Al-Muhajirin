import AuthenticatedLayout from "@/layouts/authenticated-layout";
import { Head, Link, useForm } from "@inertiajs/react";
import { PageProps } from "@/types";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { Textarea } from "@/components/ui/textarea";
import { RadioGroup, RadioGroupItem } from "@/components/ui/radio-group";
import { Popover, PopoverContent, PopoverTrigger } from "@/components/ui/popover";
import { Checkbox } from "@/components/ui/checkbox";
import EmojiPicker, { EmojiClickData } from "emoji-picker-react";
import { useState } from "react";
import { ArrowLeft } from "lucide-react";
import { toast } from "sonner";

export default function ProgramCreate() {
    const { data, setData, post, processing, errors } = useForm({
        emoji: "📝",
        title: "",
        description: "",
        schedule_type: "one_time",
        start_date: "",
        end_date: "",
        start_time: "",
        end_time: "",
        day_of_week: [] as string[],
        custom_text: "",
    });

    const [isEmojiOpen, setIsEmojiOpen] = useState(false);

    const onEmojiClick = (emojiData: EmojiClickData) => {
        setData("emoji", emojiData.emoji);
        setIsEmojiOpen(false);
    };

    const handleDayChange = (day: string, checked: boolean) => {
        if (checked) {
            setData("day_of_week", [...data.day_of_week, day]);
        } else {
            setData("day_of_week", data.day_of_week.filter((d) => d !== day));
        }
    };

    const submit = (e: React.FormEvent) => {
        e.preventDefault();
        post(route("programs.store"), {
            onSuccess: () => toast.success("Program berhasil dibuat"),
            onError: () => toast.error("Gagal membuat program"),
        });
    };

    const days = ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"];

    return (
        <AuthenticatedLayout
            header={
                <div className="flex items-center gap-4">
                    <Button variant="ghost" size="icon" asChild>
                        <Link href={route("programs.index")}>
                            <ArrowLeft className="w-4 h-4" />
                        </Link>
                    </Button>
                    <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                        Tambah Program Baru
                    </h2>
                </div>
            }
        >
            <Head title="Tambah Program" />

            <div className="py-12">
                <div className="max-w-3xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <form onSubmit={submit} className="space-y-6">
                            {/* Emoji & Title */}
                            <div className="flex gap-4">
                                <div className="flex flex-col space-y-2">
                                    <Label>Emoji</Label>
                                    <Popover open={isEmojiOpen} onOpenChange={setIsEmojiOpen}>
                                        <PopoverTrigger asChild>
                                            <Button
                                                variant="outline"
                                                className="w-16 h-10 text-2xl px-0"
                                                type="button"
                                            >
                                                {data.emoji}
                                            </Button>
                                        </PopoverTrigger>
                                        <PopoverContent className="w-auto p-0">
                                            <EmojiPicker onEmojiClick={onEmojiClick} />
                                        </PopoverContent>
                                    </Popover>
                                </div>
                                <div className="flex-1 space-y-2">
                                    <Label htmlFor="title">Judul Program</Label>
                                    <Input
                                        id="title"
                                        value={data.title}
                                        onChange={(e) => setData("title", e.target.value)}
                                        placeholder="Contoh: Kajian Rutin"
                                        required
                                    />
                                    {errors.title && (
                                        <p className="text-sm text-red-500">{errors.title}</p>
                                    )}
                                </div>
                            </div>

                            {/* Description */}
                            <div className="space-y-2">
                                <Label htmlFor="description">Deskripsi</Label>
                                <Textarea
                                    id="description"
                                    value={data.description}
                                    onChange={(e) => setData("description", e.target.value)}
                                    placeholder="Jelaskan detail program..."
                                    className="h-32"
                                    required
                                />
                                {errors.description && (
                                    <p className="text-sm text-red-500">{errors.description}</p>
                                )}
                            </div>

                            {/* Schedule Type */}
                            <div className="space-y-4 border-t pt-4">
                                <Label className="text-base">Jadwal (Tampilan Saja)</Label>
                                <RadioGroup
                                    value={data.schedule_type}
                                    onValueChange={(val) => setData("schedule_type", val)}
                                    className="flex gap-6"
                                >
                                    <div className="flex items-center space-x-2">
                                        <RadioGroupItem value="one_time" id="one_time" />
                                        <Label htmlFor="one_time">Sekali Waktu</Label>
                                    </div>
                                    <div className="flex items-center space-x-2">
                                        <RadioGroupItem value="weekly" id="weekly" />
                                        <Label htmlFor="weekly">Mingguan</Label>
                                    </div>
                                    <div className="flex items-center space-x-2">
                                        <RadioGroupItem value="custom" id="custom" />
                                        <Label htmlFor="custom">Custom</Label>
                                    </div>
                                </RadioGroup>
                            </div>

                            {/* Conditional Schedule Fields */}
                            <div className="grid md:grid-cols-2 gap-4 bg-gray-50 p-4 rounded-lg">
                                {data.schedule_type === "one_time" && (
                                    <>
                                        <div className="space-y-2">
                                            <Label>Tanggal</Label>
                                            <Input
                                                type="date"
                                                value={data.start_date}
                                                onChange={(e) => setData("start_date", e.target.value)}
                                            />
                                        </div>
                                        <div className="grid grid-cols-2 gap-4">
                                            <div className="space-y-2">
                                                <Label>Jam Mulai</Label>
                                                <Input
                                                    type="time"
                                                    value={data.start_time}
                                                    onChange={(e) => setData("start_time", e.target.value)}
                                                />
                                            </div>
                                            <div className="space-y-2">
                                                <Label>Jam Selesai</Label>
                                                <Input
                                                    type="time"
                                                    value={data.end_time}
                                                    onChange={(e) => setData("end_time", e.target.value)}
                                                />
                                            </div>
                                        </div>
                                    </>
                                )}

                                {data.schedule_type === "weekly" && (
                                    <>
                                        <div className="space-y-2 col-span-2">
                                            <Label className="mb-2 block">Hari</Label>
                                            <div className="grid grid-cols-2 sm:grid-cols-4 gap-4">
                                                {days.map((day) => (
                                                    <div key={day} className="flex items-center space-x-2">
                                                        <Checkbox
                                                            id={day}
                                                            checked={data.day_of_week.includes(day)}
                                                            onCheckedChange={(checked) => 
                                                                handleDayChange(day, checked === true)
                                                            }
                                                        />
                                                        <Label htmlFor={day} className="font-normal cursor-pointer">
                                                            {day}
                                                        </Label>
                                                    </div>
                                                ))}
                                            </div>
                                        </div>
                                        <div className="grid grid-cols-2 gap-4 col-span-2 md:col-span-1">
                                            <div className="space-y-2">
                                                <Label>Jam Mulai</Label>
                                                <Input
                                                    type="time"
                                                    value={data.start_time}
                                                    onChange={(e) => setData("start_time", e.target.value)}
                                                />
                                            </div>
                                            <div className="space-y-2">
                                                <Label>Jam Selesai</Label>
                                                <Input
                                                    type="time"
                                                    value={data.end_time}
                                                    onChange={(e) => setData("end_time", e.target.value)}
                                                />
                                            </div>
                                        </div>
                                    </>
                                )}

                                {data.schedule_type === "custom" && (
                                    <div className="col-span-2 space-y-2">
                                        <Label>Teks Jadwal Custom</Label>
                                        <Input
                                            value={data.custom_text}
                                            onChange={(e) => setData("custom_text", e.target.value)}
                                            placeholder="Contoh: Setiap Ahad ke-2 & ke-4, Ba'da Isya"
                                        />
                                    </div>
                                )}
                            </div>

                            <div className="flex justify-end gap-4 pt-4">
                                <Button variant="outline" asChild>
                                    <Link href={route("programs.index")}>Batal</Link>
                                </Button>
                                <Button type="submit" disabled={processing}>
                                    {processing ? "Menyimpan..." : "Simpan Program"}
                                </Button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
