import {
    Distribution,
    ZakatDistributionAdmin,
} from "@/components/zakat-distribution-admin";
import AuthenticatedLayout from "@/layouts/authenticated-layout";
import { Head } from "@inertiajs/react";

interface Kategori {
    id: string;
    nama: string;
}

export default function DistribusiLainnya(props: {
    distribusiZakatLainnya: Distribution[];
    kategoris: Kategori[];
    availableHijriYears?: number[];
    filters?: any;
}) {

    return (
        <AuthenticatedLayout header="Dashboard">
            <Head title="Dashboard Zakat" />

            <main className="p-6 space-y-6">
                <div className="flex items-center justify-between">
                    <h1 className="text-3xl font-bold tracking-tight">
                        Manajemen Distribusi Zakat Lainnya
                    </h1>
                </div>
                <ZakatDistributionAdmin
                    distribusiZakatLainnya={props.distribusiZakatLainnya}
                    kategoris={props.kategoris}
                    availableHijriYears={props.availableHijriYears}
                    filters={props.filters}
                />
            </main>
        </AuthenticatedLayout>
    );
}
