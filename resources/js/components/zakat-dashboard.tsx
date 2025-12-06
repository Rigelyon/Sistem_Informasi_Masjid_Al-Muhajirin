import { router } from "@inertiajs/react";
import { useState, useEffect } from "react";
import { Search, Filter, PlusCircle } from "lucide-react";

import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from "@/components/ui/dialog";
import { Label } from "@/components/ui/label";
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from "@/components/ui/select";

import type { ZakatRecord } from "@/lib/types";

import DataTable from "./data-table";

export default function ZakatDashboard(props: { 
    bayarZakat: ZakatRecord[];
    selectedYear?: number;
    availableYears?: number[];
    filters?: {
        tahun_hijriah?: string;
        bulan_hijriah?: string;
        year?: string;
    };
    availableHijriYears?: number[];
}) {
    const [data, setData] = useState<ZakatRecord[]>(props.bayarZakat);
    const [filteredData, setFilteredData] =
        useState<ZakatRecord[]>(props.bayarZakat);
    const [searchQuery, setSearchQuery] = useState("");
    const [statusFilter, setStatusFilter] = useState("all");
    const [paymentTypeFilter, setPaymentTypeFilter] = useState("all");
    const [currentPage, setCurrentPage] = useState(1);
    const [rowsPerPage, setRowsPerPage] = useState(10);
    const [isGenerating, setIsGenerating] = useState(false);

    useEffect(() => {
        setData(props.bayarZakat);
    }, [props.bayarZakat]);

    useEffect(() => {
        let result = [...data];

        // Apply search filter
        if (searchQuery) {
            const query = searchQuery.toLowerCase();
            result = result.filter(
                (item) =>
                    item.nama_KK?.toLowerCase()?.includes(query) ||
                    item.nomor_KK?.toLowerCase()?.includes(query) ||
                    item.jenis_bayar?.toLowerCase()?.includes(query)
            );
        }

        // Apply status filter
        if (statusFilter !== "all") {
            result = result.filter((item) => item.status === statusFilter);
        }

        // Apply payment type filter
        if (paymentTypeFilter !== "all") {
            result = result.filter(
                (item) => item.jenis_bayar === paymentTypeFilter
            );
        }

        setFilteredData(result);
        setCurrentPage(1); // Reset to first page when filters change
    }, [searchQuery, statusFilter, paymentTypeFilter, data]);

    const handleSearch = (e: React.ChangeEvent<HTMLInputElement>) => {
        setSearchQuery(e.target.value);
    };

    const handleStatusFilterChange = (value: string) => {
        setStatusFilter(value);
    };

    const handlePaymentTypeFilterChange = (value: string) => {
        setPaymentTypeFilter(value);
    };

    const handleRowsPerPageChange = (value: string) => {
        setRowsPerPage(Number.parseInt(value));
        setCurrentPage(1); // Reset to first page when rows per page changes
    };

    const updateRecord = (updatedRecord: ZakatRecord) => {
        const updatedData = data.map((record) =>
            record.id === updatedRecord.id ? updatedRecord : record
        );
        setData(updatedData);
    };

    const [isPeriodDialogOpen, setIsPeriodDialogOpen] = useState(false);
    const [periodYear, setPeriodYear] = useState("");
    
    // Convert available years to string for Select
    const yearOptions = props.availableHijriYears?.map(y => String(y)) || [];
    
    // Hijri Months
    const hijriMonths = [
        "Muharram", "Safar", "Rabiul Awal", "Rabiul Akhir",
        "Jumadil Awal", "Jumadil Akhir", "Rajab", "Sya'ban",
        "Ramadhan", "Syawal", "Zulqaidah", "Zulhijjah"
    ];

    const handleFilterChange = (key: string, value: string) => {
        router.get(
            route("bayar.zakat.index"),
            { ...props.filters, [key]: value },
            { preserveState: true, preserveScroll: true }
        );
    };

    const handleGenerateUnified = () => {
        if (!periodYear) {
            alert("Harap pilih Tahun Hijriah");
            return;
        }

        const confirmMsg = `Buka Periode Zakat untuk ${periodYear} H?\n\nMembuka periode baru akan MENGUNCI fitur generate untuk tahun-tahun sebelumnya. Namun anda masih bisa mengedit data sebelumnya. Lanjutkan?`;
        
        if (confirm(confirmMsg)) {
            setIsGenerating(true);
            router.post(route("bayar.zakat.generate"), {
                tahun_hijriah: periodYear
            }, {
                onFinish: () => {
                    setIsGenerating(false);
                    setIsPeriodDialogOpen(false);
                },
                preserveScroll: true
            });
        }
    };

    return (
        <div className="">
            <div className="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
                <h1 className="text-3xl font-bold text-gray-800 mb-4 md:mb-0">
                    Manajemen Pembayaran Zakat
                </h1>
                
                <div className="flex flex-wrap gap-2 items-center">
                    {/* Filter Tahun Hijriah */}
                    <Select
                        value={props.filters?.tahun_hijriah || ""}
                        onValueChange={(val) => handleFilterChange("tahun_hijriah", val)}
                    >
                        <SelectTrigger className="w-[120px] bg-white">
                            <SelectValue placeholder="Tahun (H)" />
                        </SelectTrigger>
                        <SelectContent>
                            {yearOptions.map((year) => (
                                <SelectItem key={year} value={year}>
                                    {year} H
                                </SelectItem>
                            ))}
                        </SelectContent>
                    </Select>
                    
                     {/* Filter Bulan Hijriah REMOVED */}

                    {/* Unified Generator Dialog */}
                    <Dialog open={isPeriodDialogOpen} onOpenChange={setIsPeriodDialogOpen}>
                        <DialogTrigger asChild>
                            <Button className="bg-emerald-600 hover:bg-emerald-700 text-white">
                                <PlusCircle className="w-4 h-4 mr-2" />
                                Buka Periode
                            </Button>
                        </DialogTrigger>
                        <DialogContent>
                            <DialogHeader>
                                <DialogTitle>Buka Periode Zakat Baru</DialogTitle>
                                <DialogDescription>
                                    Masukkan Tahun Hijriah untuk membuat tagihan dan daftar distribusi baru.
                                </DialogDescription>
                            </DialogHeader>
                            <div className="grid gap-4 py-4">
                                <div className="grid grid-cols-4 items-center gap-4">
                                    <Label htmlFor="hijri-year" className="text-right">Tahun</Label>
                                    <Input 
                                        id="hijri-year" 
                                        placeholder="Contoh: 1446" 
                                        className="col-span-3"
                                        value={periodYear}
                                        onChange={(e) => setPeriodYear(e.target.value)}
                                        type="number"
                                    />
                                </div>
                            </div>
                            <DialogFooter>
                                <Button variant="outline" onClick={() => setIsPeriodDialogOpen(false)}>Batal</Button>
                                <Button onClick={handleGenerateUnified} disabled={isGenerating}>
                                    {isGenerating ? "Memproses..." : "Buka Periode"}
                                </Button>
                            </DialogFooter>
                        </DialogContent>
                    </Dialog>
                </div>
            </div>

            <Card>
                <CardHeader className="pb-2">
                    {/* <CardTitle className="text-xl font-semibold text-gray-700">Zakat Payment Records</CardTitle> */}
                    <div className="flex flex-col items-start justify-between gap-4 mt-4 md:flex-row md:items-center">
                        <div className="flex flex-col w-full gap-2 sm:flex-row md:w-auto">
                            {/* <div className="flex items-center gap-2">
                                <Filter className="w-4 h-4 text-gray-500" />
                                <Select
                                    value={paymentTypeFilter}
                                    onValueChange={
                                        handlePaymentTypeFilterChange
                                    }
                                >
                                    <SelectTrigger className="w-[140px]">
                                        <SelectValue placeholder="Payment Type" />
                                    </SelectTrigger>
                                    <SelectContent>
                                        <SelectItem value="all">
                                            Semua Jenis
                                        </SelectItem>
                                        <SelectItem value="beras">
                                            Beras
                                        </SelectItem>
                                        <SelectItem value="uang">
                                            Uang
                                        </SelectItem>
                                    </SelectContent>
                                </Select>
                            </div> */}

                            <div className="flex items-center gap-2">
                                {/* <Filter className="w-4 h-4 text-gray-500" /> */}
                                <Select
                                    value={statusFilter}
                                    onValueChange={handleStatusFilterChange}
                                >
                                    <SelectTrigger className="w-[140px]">
                                        <SelectValue placeholder="Status" />
                                    </SelectTrigger>
                                    <SelectContent>
                                        <SelectItem value="all">
                                            Semua Status
                                        </SelectItem>
                                        <SelectItem value="pending">
                                            Pending
                                        </SelectItem>
                                        <SelectItem value="lunas">
                                            Lunas
                                        </SelectItem>
                                    </SelectContent>
                                </Select>
                            </div>
                        </div>

                        <div className="relative w-full md:w-auto">
                            <Search className="absolute w-4 h-4 text-gray-500 transform -translate-y-1/2 left-3 top-1/2" />
                            <Input
                                placeholder="Cari berdasarkan Nama, Nomor KK..."
                                value={searchQuery}
                                onChange={handleSearch}
                                className="pl-9 w-full md:w-[300px]"
                            />
                        </div>
                    </div>
                </CardHeader>
                <CardContent>
                    <DataTable
                        data={filteredData}
                        currentPage={currentPage}
                        setCurrentPage={setCurrentPage}
                        rowsPerPage={rowsPerPage}
                        setRowsPerPage={handleRowsPerPageChange}
                        updateRecord={updateRecord}
                    />
                </CardContent>
            </Card>
        </div>
    );
}
