"use client";

import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from "@/components/ui/table";
import { Button } from "@/components/ui/button";
import { Badge } from "@/components/ui/badge";
import { Edit, Trash2 } from "lucide-react";
import type { ZakatDistribution } from "@/lib/data";
import { DistribusiZakat } from "@/pages/distribusi";

interface ZakatDistributionTableProps {
    distributions: DistribusiZakat[];
    onEdit: (distribution: DistribusiZakat) => void;
    onDelete: (id: number) => void;
    searchQuery?: string;
}

export default function ZakatDistributionTable({
    distributions,
    onEdit,
    onDelete,
    searchQuery,
}: ZakatDistributionTableProps) {
    return (
        <div className="overflow-x-auto">
            <Table>
                <TableHeader>
                    <TableRow>
                        <TableHead>Nama</TableHead>
                        <TableHead>Jenis Bantuan</TableHead>
                        <TableHead>Jumlah Beras</TableHead>
                        <TableHead>Jumlah Uang</TableHead>
                        <TableHead>Status</TableHead>
                        <TableHead>Kategori</TableHead>
                        <TableHead className="text-right">Aksi</TableHead>
                    </TableRow>
                </TableHeader>
                <TableBody>
                    {distributions.length === 0 ? (
                        <TableRow>
                            <TableCell
                                colSpan={7}
                                className="py-6 text-center text-muted-foreground"
                            >
                                {searchQuery
                                    ? "Tidak ada data distribusi yang cocok ditemukan"
                                    : "Tidak ada data distribusi ditemukan"}
                            </TableCell>
                        </TableRow>
                    ) : (
                        distributions.map((distribution, index) => (
                            <TableRow key={distribution.id}>
                                <TableCell className="font-medium">
                                    {distribution?.warga?.nama}
                                </TableCell>
                                <TableCell>
                                    {distribution.jenis_bantuan === "beras"
                                        ? "Beras"
                                        : distribution.jenis_bantuan === "uang"
                                        ? "Uang"
                                        : "-"}
                                </TableCell>
                                <TableCell>
                                    {distribution.jumlah_beras
                                        ? `${distribution.jumlah_beras} kg`
                                        : "-"}
                                </TableCell>
                                <TableCell>
                                    {distribution.jumlah_uang
                                        ? new Intl.NumberFormat("id-ID", {
                                              style: "currency",
                                              currency: "IDR",
                                              maximumFractionDigits: 0,
                                          }).format(distribution.jumlah_uang)
                                        : "-"}
                                </TableCell>
                                <TableCell>
                                    <Badge
                                        variant={
                                            distribution?.status === "terkirim"
                                                ? "default"
                                                : "secondary"
                                        }
                                        className={
                                            distribution?.status === "terkirim"
                                                ? "bg-green-100 text-green-800 hover:bg-green-100"
                                                : "bg-orange-100 text-orange-800 hover:bg-orange-100"
                                        }
                                    >
                                        {distribution?.status === "terkirim"
                                            ? "Terkirim"
                                            : "Belum Terkirim"}
                                    </Badge>
                                </TableCell>
                                <TableCell>
                                    {distribution?.kategori?.nama || "-"}
                                </TableCell>
                                <TableCell className="text-right">
                                    <div className="flex justify-end gap-2">
                                        <Button
                                            variant="ghost"
                                            size="icon"
                                            onClick={() => onEdit(distribution)}
                                            className="w-8 h-8"
                                        >
                                            <Edit className="w-4 h-4" />
                                            <span className="sr-only">
                                                Edit
                                            </span>
                                        </Button>
                                    </div>
                                </TableCell>
                            </TableRow>
                        ))
                    )}
                </TableBody>
            </Table>
        </div>
    );
}
