<div class="font-sans">
    <x-utils.sidebar-modal wire:model.defer="open" max-width="lg">
        <x-slot name="title">
            <div class="flex items-center space-x-3">
                <div>
                    <x:icons.bell solid class="text-primary-400 h-8 w-8"/>
                </div>
                <p>
                    Notifications
                </p>
            </div>
        </x-slot>
        <div @open-notification-modal.window="$wire.openNotificationsModal()">
            <div class="mb-4">
                <div class="text-right flex-grow">
                    @if(\App\Models\Notification::query()->whereNull('seen_at')->count() != 0)
                        <div x-data="{deleteButton: false}" class="flex flex-row-reverse items-center">
                            <button x-on:click="deleteButton = !deleteButton" @click.away="deleteButton = false"
                                    :class="{ 'rounded-r': deleteButton, 'rounded': !deleteButton }"
                                    class="z-20 font-sans inline-flex items-center px-4 py-2 bg-primary-500 border border-transparent text-sm text-white uppercase hover:bg-primary-600 focus:outline-none transition-all ease-in-out duration-500">
                                Mark all as read
                            </button>
                            <div x-show="deleteButton"
                                 x-transition:enter="transform transition ease-in-out duration-300"
                                 x-transition:enter-start="translate-x-full"
                                 x-transition:enter-end="translate-x-0"
                                 x-transition:leave="transform transition ease-in-out duration-300"
                                 x-transition:leave-start="translate-x-0"
                                 x-transition:leave-end="translate-x-full">
                                <button class="z-10 font-sans inline-flex items-center px-4 py-2 bg-tertiary-500 border border-transparent rounded-l text-sm text-white uppercase hover:bg-tertiary-600 focus:outline-none transition ease-in-out duration-150"
                                        wire:click.prevent="markNotificationsAsSeen">
                                    Confirm
                                </button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <ul class="space-y-4 font-sora">
                @forelse($notifications as $notification)
                    <li class="{{ (isset($notification['seen_at']) && $notification['seen_at'] <= now()) ? 'bg-white' : 'bg-primary-50' }} dark:bg-quaternary-100 dark:hover:bg-opacity-70 dark:text-white hover:bg-primary-100 hover:translate-x-0.5 hover:drop-shadow-lg transition duration-200 cursor-pointer rounded-lg p-3">
                        @switch($notification['type'])
                            @case(\App\Enums\NotificationEnum::PROJECT_CLAIM)
                                <a title="Click to go to Project" href="{{ route('projects.show', $notification['notifiable_identifier']) }}">
                                    <div class="flex items-center space-x-3">
                                        <div class="p-2 rounded-lg bg-primary-400 bg-opacity-20">
                                            <x:icons.inbox-arrow-down solid class="text-primary-400 h-5 w-5"/>
                                        </div>
                                        <b>
                                            {{ $notification['type']->label() }}
                                        </b>
                                    </div>
                                    <div class="flex items-center space-x-3 pt-4">
                                        <div class="flex-shrink-0 bg-primary-500 h-20 w-20 rounded-full overflow-hidden">
                                            <img class="h-full w-full object-cover" src="{{$notification['image']}}"
                                                 alt="img">
                                        </div>
                                        <div class="flex flex-col space-y-3 w-full">
                                            <p>{!! $notification['title'] !!}</p>
                                            <b class="text-right text-gray-500 dark:text-quaternary-50">{{$notification['created_at_diff_for_humans']}}</b>
                                        </div>
                                    </div>
                                </a>
                                @break
                            @case(\App\Enums\NotificationEnum::PROJECT_APPROVED)
                                <a title="Click to go to Project" href="{{ route('projects.show', $notification['notifiable_identifier']) }}">
                                    <div class="flex items-center space-x-3">
                                        <div class="p-2 rounded-lg bg-primary-400 bg-opacity-20">
                                            <x:icons.check-badge solid class="text-primary-400 h-5 w-5"/>
                                        </div>
                                        <b>
                                            {{ $notification['type']->label() }}
                                        </b>
                                    </div>
                                    <div class="flex items-center space-x-3 pt-4">
                                        <div class="flex-shrink-0 bg-primary-500 h-20 w-20 rounded-full overflow-hidden">
                                            <img class="h-full w-full object-cover" src="{{$notification['image']}}"
                                                 alt="img">
                                        </div>
                                        <div class="flex flex-col space-y-3 w-full">
                                            <p>{!! $notification['title'] !!}</p>
                                            <b class="text-right text-gray-500 dark:text-quaternary-50">{{$notification['created_at_diff_for_humans']}}</b>
                                        </div>
                                    </div>
                                </a>
                                @break
                            @case(\App\Enums\NotificationEnum::PROJECT_COMPLETED)
                                <a title="Click to go to Project" href="{{ route('projects.show', $notification['notifiable_identifier']) }}">
                                    <div class="flex items-center space-x-3">
                                        <div class="p-2 rounded-lg bg-primary-400 bg-opacity-20">
                                            <x:icons.hand-thumb-up solid class="text-primary-400 h-5 w-5"/>
                                        </div>
                                        <b>
                                            {{ $notification['type']->label() }}
                                        </b>
                                    </div>
                                    <div class="flex items-center space-x-3 pt-4">
                                        <div class="flex-shrink-0 bg-primary-500 h-20 w-20 rounded-full overflow-hidden">
                                            <img class="h-full w-full object-cover" src="{{$notification['image']}}"
                                                 alt="img">
                                        </div>
                                        <div class="flex flex-col space-y-3 w-full">
                                            <p>{!! $notification['title'] !!}</p>
                                            <b class="text-right text-gray-500 dark:text-quaternary-50">{{$notification['created_at_diff_for_humans']}}</b>
                                        </div>
                                    </div>
                                </a>
                                @break
                            @case(\App\Enums\NotificationEnum::PROJECT_STATUS_UPDATE)
                                <a title="Click to go to Project" href="{{ route('projects.show', $notification['notifiable_identifier']) }}">
                                    <div class="flex items-center space-x-3">
                                        <div class="p-2 rounded-lg bg-primary-400 bg-opacity-20">
                                            <x:icons.arrow-path solid class="text-primary-400 h-5 w-5"/>
                                        </div>
                                        <b>
                                            {{ $notification['type']->label() }}
                                        </b>
                                    </div>
                                    <div class="flex items-center space-x-3 pt-4">
                                        <div class="flex-shrink-0 bg-primary-500 h-20 w-20 rounded-full overflow-hidden">
                                            <img class="h-full w-full object-cover" src="{{$notification['image']}}"
                                                 alt="img">
                                        </div>
                                        <div class="flex flex-col space-y-3 w-full">
                                            <p>{!! $notification['title'] !!}</p>
                                            <b class="text-right text-gray-500 dark:text-quaternary-50">{{$notification['created_at_diff_for_humans']}}</b>
                                        </div>
                                    </div>
                                </a>
                                @break
                            @case(\App\Enums\NotificationEnum::USER_REGISTRATION)
                                <a title="Click to go to User" href="{{ route('users.show', $notification['notifiable_identifier']) }}">
                                    <div class="flex items-center space-x-3">
                                        <div class="p-2 rounded-lg bg-primary-400 bg-opacity-20">
                                            <x:icons.users solid class="text-primary-400 h-5 w-5"/>
                                        </div>
                                        <b>
                                            {{ $notification['type']->label() }}
                                        </b>
                                    </div>
                                    <div class="flex items-center space-x-3 pt-4">
                                        <div class="flex-shrink-0 bg-primary-500 h-20 w-20 rounded-full overflow-hidden">
                                            <img class="h-full w-full object-cover" src="{{$notification['image']}}"
                                                 alt="img">
                                        </div>
                                        <div class="flex flex-col space-y-3 w-full">
                                            <p>{!! $notification['title'] !!}</p>
                                            <b class="text-right text-gray-500 dark:text-quaternary-50">{{$notification['created_at_diff_for_humans']}}</b>
                                        </div>
                                    </div>
                                </a>
                                @break
                            @case(\App\Enums\NotificationEnum::PROJECT_NEW_MESSAGE)
                                <a title="Click to go to Project" href="{{ route('projects.show', $notification['notifiable_identifier']) }}">
                                    <div class="flex items-center space-x-3">
                                        <div class="p-2 rounded-lg bg-primary-400 bg-opacity-20">
                                            <x:icons.chat-bubble solid class="text-primary-400 h-5 w-5"/>
                                        </div>
                                        <b>
                                            {{ $notification['type']->label() }}
                                        </b>
                                    </div>
                                    <div class="flex items-center space-x-3 pt-4">
                                        <div class="flex-shrink-0 bg-primary-500 h-20 w-20 rounded-full overflow-hidden">
                                            <img class="h-full w-full object-cover" src="{{$notification['image']}}"
                                                 alt="img">
                                        </div>
                                        <div class="flex flex-col space-y-3 w-full">
                                            <p>{!! $notification['title'] !!}</p>
                                            <b class="text-right text-gray-500 dark:text-quaternary-50">{{$notification['created_at_diff_for_humans']}}</b>
                                        </div>
                                    </div>
                                </a>
                                @break
                            @case(\App\Enums\NotificationEnum::ADMINISTRATOR_MENTION)
                                <a title="Click to go to Project" href="{{ route('projects.show', $notification['notifiable_identifier']) }}">
                                    <div class="flex items-center space-x-3">
                                        <div class="p-2 rounded-lg bg-primary-400 bg-opacity-20">
                                            <x:icons.at solid class="text-primary-400 h-5 w-5"/>
                                        </div>
                                        <b>
                                            {{ $notification['type']->label() }}
                                        </b>
                                    </div>
                                    <div class="flex items-center space-x-3 pt-4">
                                        <div class="flex-shrink-0 bg-primary-500 h-20 w-20 rounded-full overflow-hidden">
                                            <img class="h-full w-full object-cover" src="{{$notification['image']}}"
                                                 alt="img">
                                        </div>
                                        <div class="flex flex-col space-y-3 w-full">
                                            <p>{!! $notification['title'] !!}</p>
                                            <b class="text-right text-gray-500 dark:text-quaternary-50">{{$notification['created_at_diff_for_humans']}}</b>
                                        </div>
                                    </div>
                                </a>
                                @break
                            @case(\App\Enums\NotificationEnum::USER_APPROVED)
                                <a title="Click to go to User" href="{{ route('users.show', $notification['notifiable_identifier']) }}">
                                    <div class="flex items-center space-x-3">
                                        <div class="p-2 rounded-lg bg-primary-400 bg-opacity-20">
                                            <x:icons.check-badge solid class="text-primary-400 h-5 w-5"/>
                                        </div>
                                        <b>
                                            {{ $notification['type']->label() }}
                                        </b>
                                    </div>
                                    <div class="flex items-center space-x-3 pt-4">
                                        <div class="flex-shrink-0 bg-primary-500 h-20 w-20 rounded-full overflow-hidden">
                                            <img class="h-full w-full object-cover" src="{{$notification['image']}}"
                                                 alt="img">
                                        </div>
                                        <div class="flex flex-col space-y-3 w-full">
                                            <p>{!! $notification['title'] !!}</p>
                                            <b class="text-right text-gray-500 dark:text-quaternary-50">{{$notification['created_at_diff_for_humans']}}</b>
                                        </div>
                                    </div>
                                </a>
                                @break
                        @endswitch
                    </li>
                @empty
                    <li class="flex flex-col items-center w-full mt-10">
                        <div>
                            <x:icons.bell-slash class="text-secondary-900 dark:text-quaternary-50 h-24 w-24"/>
                        </div>
                        <div class="p-5 text-center text-secondary-900 dark:text-quaternary-50 font-bold">
                            All Cleared Up!
                        </div>
                    </li>
                @endforelse
            </ul>
        </div>
    </x-utils.sidebar-modal>
</div>

