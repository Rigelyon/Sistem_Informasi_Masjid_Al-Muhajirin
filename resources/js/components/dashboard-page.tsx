"use client";

import { useState } from "react";
import {
    AlertCircle,
    ArrowDown,
    ArrowUp,
    Calendar,
    ChevronDown,
    CreditCard,
    DollarSign,
    Filter,
    GrapeIcon as GrainIcon,
    Layers,
    LayoutDashboard,
    LogOut,
    Menu,
    Package,
    PieChart,
    Search,
    Settings,
    Users,
} from "lucide-react";
import {
    Card,
    CardContent,
    CardDescription,
    CardFooter,
    CardHeader,
    CardTitle,
} from "@/components/ui/card";
import { Button } from "@/components/ui/button";
import { Avatar, AvatarFallback, AvatarImage } from "@/components/ui/avatar";
import { Badge } from "@/components/ui/badge";
import { Input } from "@/components/ui/input";
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuSeparator,
    DropdownMenuTrigger,
} from "@/components/ui/dropdown-menu";
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from "@/components/ui/select";
import { Alert, AlertDescription, AlertTitle } from "@/components/ui/alert";
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from "@/components/ui/table";
import { Sheet, SheetContent } from "@/components/ui/sheet";
// import {
//     AreaChart,
//     BarChart,
//     PieChart as PieChartComponent,
// } from "@/components/ui/chart";

import { router } from "@inertiajs/react";

export default function DashboardPage(props: {
    totalZakatBeras: number;
    totalZakatUang: number;
    totalDistribusiZakatUang: number;
    totalDistribusiZakatBeras: number;
    totalBerasDistribusiLainnya: number;
    totalUangDistribusiLainnya: number;
    sudahBayar: number;
    wargaWajib: number;
    belumBayar: number;
    jumlahWargaTerdistribusi: number;
    jumlahPenerimaLainnya: number;
    selectedYear: number;
    availableYears: number[];
}) {
    const [isSidebarOpen, setIsSidebarOpen] = useState(false);

    const handleYearChange = (year: string) => {
        router.get(
            route("dashboard"),
            { tahun_hijriah: year },
            { preserveState: true, preserveScroll: true }
        );
    };

    // Summary Data derived from props
    const summaryData = {
        totalCollected: {
            idr: props.totalZakatUang,
            kg: props.totalZakatBeras,
        },
        totalDistributed: {
            idr: props.totalDistribusiZakatUang,
            kg: props.totalDistribusiZakatBeras,
        },
        total_warga_wajib_zakat: props.wargaWajib,
        sudah_bayar: props.sudahBayar,
        belum_bayar: props.belumBayar,
        beneficiaries: 85,
        pendingDistributions: 12,
    };

    const formatCurrency = (value: number) => {
        // ...
        return new Intl.NumberFormat("id-ID", {
            style: "currency",
            currency: "IDR",
            minimumFractionDigits: 0,
            maximumFractionDigits: 0,
        }).format(value);
    };

    return (
        <div className="flex min-h-screen">
            {/* Main Dashboard Content */}
            <main className="flex-1 pt-6 overflow-auto">
                <div className="flex flex-col gap-6">
                    {/* Page Title and Filter */}
                    <div className="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                        <div>
                            <h1 className="text-4xl font-bold">Dashboard</h1>
                        </div>
                        <div className="flex flex-col gap-2 sm:flex-row">
                            <Select
                                value={String(props.selectedYear)}
                                onValueChange={handleYearChange}
                            >
                                <SelectTrigger className="w-full sm:w-[180px] bg-white">
                                    <SelectValue placeholder="Pilih Tahun" />
                                </SelectTrigger>
                                <SelectContent>
                                    {props.availableYears.map((year) => (
                                        <SelectItem
                                            key={year}
                                            value={String(year)}
                                        >
                                            {year} H
                                        </SelectItem>
                                    ))}
                                </SelectContent>
                            </Select>
                            <Button className="w-full sm:w-auto" asChild>
                                <a
                                    href={route("laporan.zakat.pdf", {
                                        tahun_hijriah: props.selectedYear,
                                    })}
                                    className="inline-flex items-center px-4 py-2 text-white bg-green-600 rounded hover:bg-green-700"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                >
                                    Export PDF
                                </a>
                            </Button>
                        </div>
                    </div>

                    {/* Summary Cards */}
                    <div className="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
                        <Card>
                            <CardHeader className="flex flex-row items-center justify-between pb-2">
                                <CardTitle className="text-sm font-medium">
                                    Total Zakat Terkumpul
                                </CardTitle>
                                <DollarSign className="w-4 h-4 text-muted-foreground" />
                            </CardHeader>
                            <CardContent>
                                <div className="text-2xl font-bold">
                                    {formatCurrency(
                                        summaryData.totalCollected.idr
                                    )}
                                </div>
                                <div className="mt-1 text-xs text-muted-foreground">
                                    <span className="font-medium">
                                        {summaryData.totalCollected.kg.toFixed(
                                            1
                                        )}{" "}
                                        Kg
                                    </span>{" "}
                                    Beras
                                </div>
                                {/* <div className="flex items-center mt-3 text-xs text-emerald-500">
                                        <ArrowUp className="w-3 h-3 mr-1" />
                                        <span>12.5% dari bulan lalu</span>
                                    </div> */}
                            </CardContent>
                        </Card>
                        <Card>
                            <CardHeader className="flex flex-row items-center justify-between pb-2">
                                <CardTitle className="text-sm font-medium">
                                    Total Zakat Tersalurkan
                                </CardTitle>
                                <Package className="w-4 h-4 text-muted-foreground" />
                            </CardHeader>
                            <CardContent>
                                <div className="text-2xl font-bold">
                                    {formatCurrency(
                                        summaryData.totalDistributed.idr
                                    )}
                                </div>
                                <div className="mt-1 text-xs text-muted-foreground">
                                    <span className="font-medium">
                                        {summaryData.totalDistributed.kg.toFixed(
                                            1
                                        )}{" "}
                                        Kg
                                    </span>{" "}
                                    Beras
                                </div>
                            </CardContent>
                        </Card>
                        <Card>
                            <CardHeader className="flex flex-row items-center justify-between pb-2">
                                <CardTitle className="text-sm font-medium">
                                    Total Zakat Lainnya Tersalurkan
                                </CardTitle>
                                <Users className="w-4 h-4 text-muted-foreground" />
                            </CardHeader>
                            <CardContent>
                                <div className="text-2xl font-bold">
                                    {formatCurrency(
                                        props.totalUangDistribusiLainnya
                                    )}
                                </div>
                                <div className="mt-1 text-xs text-muted-foreground">
                                    <span className="font-medium">
                                        {props.totalBerasDistribusiLainnya.toFixed(
                                            1
                                        )}{" "}
                                        Kg
                                    </span>{" "}
                                    Beras
                                </div>
                            </CardContent>
                        </Card>
                        <Card>
                            <CardHeader className="flex flex-row items-center justify-between pb-2">
                                <CardTitle className="text-sm font-medium">
                                    Status Pembayaran Zakat
                                </CardTitle>
                                <Users className="w-4 h-4 text-muted-foreground" />
                            </CardHeader>
                            <CardContent>
                                <div className="text-2xl font-bold">
                                    {summaryData.total_warga_wajib_zakat}/
                                    {summaryData.sudah_bayar}/
                                    {summaryData.belum_bayar}
                                </div>
                                <div className="mt-1 text-xs text-muted-foreground">
                                    Total warga wajib zakat / Sudah bayar /
                                    Belum bayar
                                </div>
                            </CardContent>
                        </Card>

                        <Card>
                            <CardHeader className="flex flex-row items-center justify-between pb-2">
                                <CardTitle className="text-sm font-medium">
                                    Jumlah Zakat Terdistribusi
                                </CardTitle>
                                <Users className="w-4 h-4 text-muted-foreground" />
                            </CardHeader>
                            <CardContent>
                                <div className="text-2xl font-bold">
                                    {props.jumlahWargaTerdistribusi} Warga
                                </div>
                                <div className="mt-1 text-xs text-muted-foreground">
                                    Sudah menerima manfaat zakat
                                </div>
                            </CardContent>
                        </Card>
                        <Card>
                            <CardHeader className="flex flex-row items-center justify-between pb-2">
                                <CardTitle className="text-sm font-medium">
                                    Jumlah Zakat Lainnya Terdistribusi
                                </CardTitle>
                                <Users className="w-4 h-4 text-muted-foreground" />
                            </CardHeader>
                            <CardContent>
                                <div className="text-2xl font-bold">
                                    {props.jumlahPenerimaLainnya} Warga
                                </div>
                                <div className="mt-1 text-xs text-muted-foreground">
                                    Sudah menerima manfaat zakat
                                </div>
                            </CardContent>
                        </Card>
                    </div>
                </div>
            </main>
            {/* </div> */}
        </div>
    );
}
