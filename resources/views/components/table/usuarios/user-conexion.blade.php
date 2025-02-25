@php
    $session = $user->sessions->first();
@endphp
<div class="space-y-6 text-xs">
    @if(isset($session))
        @if(!$session->isExpired())
            <div class="flex items-center">
                <div>
                    @if ($session->agent->isDesktop())
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 @if ( $session->isExpired())text-gray-500 @else text-green-500 @endif">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25" />
                        </svg>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 @if ( $session->isExpired())text-gray-500 @else text-green-500 @endif">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                        </svg>
                    @endif
                </div>

                <div class="ms-3">
                    <div class="text-sm text-gray-600">
                        {{ $session->agent->platform() ? $session->agent->platform() : 'Desconocido' }} - {{ $session->agent->browser() ? $session->agent->browser() : 'Desconocido' }}
                    </div>

                    <div>
                        <div class="text-xs text-gray-500">
                            {{ $session->ip_address }},

                            @if ($session->id === request()->session()->getId())
                                <span class="text-green-500 font-semibold">{{ __('This device') }}</span>
                            @else
                                Activo {{ $session->last_active }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @else
        <span>Ultima conexion {{ $user->last_login_at }}</span>
        @endif
    @else

    @endif
</div>

