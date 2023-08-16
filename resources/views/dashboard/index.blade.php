<div>
    <div class="grid grid-cols-12 gap-5">
        <div class="col-span-12 md:col-span-3 bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <x:icons.clipboard-list-o class="h-6 w-6 text-gray-400"/>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">
                                Jobs Total
                            </dt>
                            <dd>
                                <div class="text-lg font-medium text-gray-900">
                                    {{ number_format($jobsTotal) }}
                                </div>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-span-12 md:col-span-3 bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <x:icons.calendar-o class="h-6 w-6 text-gray-400"/>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">
                                Jobs Last Updated
                            </dt>
                            <dd>
                                <div class="text-lg font-medium text-gray-900">
                                    {{ $jobsLastRecordUpdatedAt ?? '-' }}
                                </div>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-span-12 md:col-span-3 bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <x:icons.clipboard-list-o class="h-6 w-6 text-gray-400"/>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">
                                Tenders Total
                            </dt>
                            <dd>
                                <div class="text-lg font-medium text-gray-900">
                                    {{ number_format($tendersTotal) }}
                                </div>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-span-12 md:col-span-3 bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <x:icons.calendar-o class="h-6 w-6 text-gray-400"/>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">
                                Tenders Last Updated
                            </dt>
                            <dd>
                                <div class="text-lg font-medium text-gray-900">
                                    {{ $tendersLastRecordUpdatedAt ?? '-' }}
                                </div>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
