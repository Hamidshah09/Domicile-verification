<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Apply for New Domicile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <label for="">Domicile Image</label>
                    <input
                    class="form-control"
                    type="file"
                    id="scan_file"
                    name="scan_file"
                    value=""
                    />
                    <x-primary-button class="ms-3">
                        {{ __('Apply for Verification') }}
                    </x-primary-button>
                    {{-- <table class="styled-table" id="originalTable">
                    <thead>
                        <th>Application No.</th>
                        <th>Application Type</th>
                        <th>Applicant Name</th>
                        <th>Application Status</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>456465</td>
                            <td>Domicile Verification</td>
                            <td>Hamid Ullah Shah</td>
                            <td>Pending</td>
                        </tr>
                    </tbody>
                   </table> --}}
                   {{-- <table id="transposedTable" class="styled-table">
                        <tr>
                            <th>Application No.</th>
                            <td>564646</td>
                        </tr>
                        <tr>
                            <th>Application Type</th>
                            <td>Domicile Verification</td>
                        </tr>
                   </table> --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
