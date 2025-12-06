import { useState, useEffect } from "react";
import { router } from "@inertiajs/react";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card";
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from "@/components/ui/select";
import ZakatDistributionTable from "./zakat-distribution-table";
import ZakatDistributionForm from "./zakat-distribution-form";
import {
    AlertDialog,
    AlertDialogAction,
    AlertDialogCancel,
    AlertDialogContent,
    AlertDialogDescription,
    AlertDialogFooter,
    AlertDialogHeader,
    AlertDialogTitle,
} from "@/components/ui/alert-dialog";
import { PlusCircle, Search } from "lucide-react";
import { type ZakatDistribution, initialZakatDistributions } from "@/lib/data";
import { DistribusiZakat } from "@/pages/distribusi";

export default function ZakatDistributionManagement(props: {
    distribusiZakat: DistribusiZakat[];
    availableHijriYears?: number[];
    filters?: any;
}) {
    const [distributions, setDistributions] = useState<DistribusiZakat[]>(
        props.distribusiZakat
    );

    // Sync state with props when filters change
    useEffect(() => {
        setDistributions(props.distribusiZakat);
    }, [props.distribusiZakat]);

    const [statusFilter, setStatusFilter] = useState<string>("all");
    const [currentPage, setCurrentPage] = useState(1);
    const [isFormOpen, setIsFormOpen] = useState(false);
    const [isAlertOpen, setIsAlertOpen] = useState(false);
    const [alertType, setAlertType] = useState<"confirmation" | "validation">(
        "confirmation"
    );
    const [editingDistribution, setEditingDistribution] =
        useState<DistribusiZakat | null>(null);
    const [formData, setFormData] = useState<Partial<DistribusiZakat>>({});
    const [searchQuery, setSearchQuery] = useState("");

    const itemsPerPage = 5;

    // Filter distributions based on status
    const filteredDistributions = distributions.filter((distribution) => {
        // Status filter
        if (statusFilter !== "all" && distribution.status !== statusFilter) {
            return false;
        }

        // Search filter - case insensitive search across multiple fields
        if (searchQuery.trim() !== "") {
            const query = searchQuery.toLowerCase();
            return (
                distribution.warga.nama.toLowerCase().includes(query) ||
                distribution.status.toLowerCase().includes(query)
            );
        }

        return true;
    });

    // Calculate pagination
    const totalPages = Math.ceil(filteredDistributions.length / itemsPerPage);
    const paginatedDistributions = filteredDistributions.slice(
        (currentPage - 1) * itemsPerPage,
        currentPage * itemsPerPage
    );

    // const handleAddDistribution = () => {
    //     setEditingDistribution(null);
    //     setFormData({
    //         status: "belum_terkirim",
    //         // distributionDate: new Date().toISOString().split("T")[0],
    //     });
    //     setIsFormOpen(true);
    // };

    const handleEditDistribution = (distribution: DistribusiZakat) => {
        setEditingDistribution(distribution);
        setFormData(distribution);
        setIsFormOpen(true);
    };

    const handleDeleteDistribution = (id: number) => {
        setDistributions(distributions.filter((d) => d.id !== id));
    };

    const handleFormSubmit = (data: Partial<DistribusiZakat>) => {
        setFormData(data);

        // Validate required fields if needed
        // (Currently commented out in your original code)

        // If we're editing an existing distribution
        if (editingDistribution) {
            // Update the distribution in the array
            setDistributions(
                distributions.map((d) =>
                    d.id === editingDistribution.id
                        ? ({ ...d, ...data } as DistribusiZakat)
                        : d
                )
            );

            // Close the form after updating
            setIsFormOpen(false);
        } else {
            // Handle new distribution case if needed
            // (Currently commented out in your original code)
        }
    };

    // const handleConfirmSubmit = () => {
    //     if (editingDistribution) {
    //         // Update existing distribution
    //         setDistributions(
    //             distributions.map((d) =>
    //                 d.id === editingDistribution.id
    //                     ? ({ ...d, ...formData } as DistribusiZakat)
    //                     : d
    //             )
    //         );
    //     } else {
    //         // Add new distribution
    //         // const newDistribution: DistribusiZakat = {
    //         //     id:
    //         //         distributions.length > 0
    //         //             ? Math.max(...distributions.map((d) => d.id)) + 1
    //         //             : 1,
    //         //     ...(formData as Omit<ZakatDistribution, "id">),
    //         // } as ZakatDistribution;

    //         // setDistributions([...distributions, newDistribution]);
    //     }

    //     setIsFormOpen(false);
    //     setIsAlertOpen(false);
    // };

    return (
        <Card className="w-full">
            <CardHeader>
                <div className="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                    <div className="flex flex-1 items-center gap-4 flex-wrap">
                        <div className="relative flex-1 md:max-w-sm">
                            <Search className="absolute w-4 h-4 text-gray-500 transform -translate-y-1/2 left-3 top-1/2" />
                            <Input
                                placeholder="Cari berdasarkan nama..."
                                value={searchQuery}
                                onChange={(e) => {
                                    setSearchQuery(e.target.value);
                                    setCurrentPage(1);
                                }}
                                className="pl-9 w-full"
                            />
                        </div>
                        <Select
                            value={props.filters?.tahun_hijriah || ""}
                            onValueChange={(val) => {
                                router.get(
                                    route("distribusi"),
                                    { ...props.filters, tahun_hijriah: val },
                                    { preserveState: true, preserveScroll: true }
                                );
                            }}
                        >
                            <SelectTrigger className="w-[130px]">
                                <SelectValue placeholder="Tahun (H)" />
                            </SelectTrigger>
                            <SelectContent>
                                {props.availableHijriYears?.map((y) => (
                                    <SelectItem key={y} value={String(y)}>
                                        {y} H
                                    </SelectItem>
                                ))}
                            </SelectContent>
                        </Select>
                        <Select
                            value={statusFilter}
                            onValueChange={(value) => {
                                setStatusFilter(value);
                                setCurrentPage(1);
                            }}
                        >
                            <SelectTrigger className="w-[140px]">
                                <SelectValue placeholder="Status" />
                            </SelectTrigger>
                            <SelectContent>
                                <SelectItem value="all">Semua Status</SelectItem>
                                <SelectItem value="terkirim">Terkirim</SelectItem>
                                <SelectItem value="belum_terkirim">Belum Terkirim</SelectItem>
                            </SelectContent>
                        </Select>
                    </div>
                </div>
            </CardHeader>
            <CardContent>
                <ZakatDistributionTable
                    distributions={paginatedDistributions}
                    onEdit={handleEditDistribution}
                    onDelete={handleDeleteDistribution}
                />

                {totalPages > 1 && (
                    <div className="flex items-center justify-between mt-4">
                        <Button
                            variant="outline"
                            onClick={() =>
                                setCurrentPage((prev) => Math.max(prev - 1, 1))
                            }
                            disabled={currentPage === 1}
                        >
                            Sebelumnya
                        </Button>
                        <span className="text-sm">
                            Halaman {currentPage} dari {totalPages}
                        </span>
                        <Button
                            variant="outline"
                            onClick={() =>
                                setCurrentPage((prev) =>
                                    Math.min(prev + 1, totalPages)
                                )
                            }
                            disabled={currentPage === totalPages}
                        >
                            Selanjutnya
                        </Button>
                    </div>
                )}

                <ZakatDistributionForm
                    isOpen={isFormOpen}
                    onClose={() => setIsFormOpen(false)}
                    onSubmit={handleFormSubmit}
                    // onSubmit={() => {}}
                    initialData={formData}
                    isEditing={!!editingDistribution}
                />

                {/* <AlertDialog open={isAlertOpen} onOpenChange={setIsAlertOpen}>
                    <AlertDialogContent>
                        <AlertDialogHeader>
                            <AlertDialogTitle>
                                {alertType === "validation"
                                    ? "Incomplete Form"
                                    : "Confirm Submission"}
                            </AlertDialogTitle>
                            <AlertDialogDescription>
                                {alertType === "validation"
                                    ? "Please complete all required fields before submitting."
                                    : "Are you sure you want to save this distribution record?"}
                            </AlertDialogDescription>
                        </AlertDialogHeader>
                        <AlertDialogFooter>
                            <AlertDialogCancel>Cancel</AlertDialogCancel>
                            {alertType === "confirmation" && (
                                <AlertDialogAction
                                    onClick={handleConfirmSubmit}
                                >
                                    Confirm
                                </AlertDialogAction>
                            )}
                        </AlertDialogFooter>
                    </AlertDialogContent>
                </AlertDialog> */}
            </CardContent>
        </Card>
    );
}
