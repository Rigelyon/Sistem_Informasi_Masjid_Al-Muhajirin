import ZakatDashboard from "@/components/zakat-dashboard";
import AuthenticatedLayout from "@/layouts/authenticated-layout";
import { ZakatRecord } from "@/lib/types";
import { Head } from "@inertiajs/react";

export default function Bayar(props: { 
    bayarZakat: ZakatRecord[];
    selectedYear?: number;
    availableYears?: number[];
    availableHijriYears?: number[];
    currentHijriYear?: number;
    filters?: any;
}) {

    return (
        <AuthenticatedLayout header="Dashboard">
            <Head title="Dashboard bayar" />

            <main className="p-6 space-y-6">
                <div className="flex items-center justify-between">
                    <h1 className="text-3xl font-bold tracking-tight">
                        Manajemen Pembayaran Zakat
                    </h1>
                </div>
                <ZakatDashboard 
                    bayarZakat={props.bayarZakat} 
                    selectedYear={props.selectedYear}
                    availableYears={props.availableYears}
                    availableHijriYears={props.availableHijriYears}
                    currentHijriYear={props.currentHijriYear}
                    filters={props.filters}
                />
            </main>
        </AuthenticatedLayout>
    );
}
