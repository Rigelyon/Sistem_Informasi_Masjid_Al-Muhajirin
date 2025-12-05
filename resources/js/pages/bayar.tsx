import ZakatDashboard from "@/components/zakat-dashboard";
import AuthenticatedLayout from "@/layouts/authenticated-layout";
import { ZakatRecord } from "@/lib/types";
import { Head } from "@inertiajs/react";

export default function Bayar(props: { 
    bayarZakat: ZakatRecord[];
    selectedYear: number;
    availableYears: number[];
}) {

    return (
        <AuthenticatedLayout header="Dashboard">
            <Head title="Dashboard bayar" />

            <main className="max-w-full min-h-screen pt-6 ">
                <ZakatDashboard 
                    bayarZakat={props.bayarZakat} 
                    selectedYear={props.selectedYear}
                    availableYears={props.availableYears}
                />
            </main>
        </AuthenticatedLayout>
    );
}
