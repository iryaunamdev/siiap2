<div>
    <!-- User update Modal -->
    <x-dialog-modal wire:model.live="showModalUsuario" maxWidth="sm">
        <x-slot name="title">
            {{ $card_title }}
        </x-slot>

        <x-slot name="content">
            <form>
                <!-- Name -->
                <div class="col-span-6 sm:col-span-4">
                    <x-label for="name" value="Nombre de usuario" />
                    <x-input id="name" type="text" class="mt-1 block w-full" required autocomplete="name"
                        wire:model='name' />
                    <x-input-error for="name" class="mt-2" />
                </div>

                <!-- email -->
                <div class="col-span-6 sm:col-span-4 mt-4">
                    <x-label for="email" value="Correo electrónico" />
                    <x-input id="email" type="email" class="mt-1 block w-full" required autocomplete="email"
                        wire:model='email' />
                    <x-input-error for="email" class="mt-2" />
                </div>

                @if (!isset($user_id))
                    <!-- password -->
                    <div class="col-span-6 sm:col-span-4 mt-4">
                        <x-label for="password" value="Contraseña" />
                        <x-input id="password" type="text" class="mt-1 block w-full" required
                            autocomplete="password" wire:model='password' />
                        <x-input-error for="password" class="mt-2" />
                    </div>
                @endif

                @if (isset($user_id))
                    <div class="flex items-center ps-4 border border-gray-200 rounded dark:border-gray-700 px-2 mt-4">
                        <div class="form-check py-2 px-2">
                            <x-checkbox wire:model.defer="activo" />
                            <x-label value="Usuario activo" class="inline-block text-sm" />
                        </div>
                    </div>
                @endif

                <div class="col-span-6 sm:col-span-4 mt-4">
                    <x-label for="roles">Asigna uno o varios roles (permisos)</x-label>
                    @foreach ($roles as $role)
                        <div class="form-check py-1">
                            <x-checkbox wire:model.defer="role_list.{{ $role->id }}" />
                            <x-label value="{{ $role->name }}" class="inline-block text-xs uppercase" />
                        </div>
                    @endforeach
                </div>
            </form>
        </x-slot>

        <x-slot name="footer">
            <x-button wire:click="store()" wire:loading.attr="disabled" class="rounded-md mr-1">
                Guardar
            </x-button>
            <x-secondary-button wire:click="closeModal()" wire:loading.attr="disabled" class="rounded-md">
                Cerrar
            </x-secondary-button>
        </x-slot>
    </x-dialog-modal>

    <!-- Change user password Modal -->
    <x-dialog-modal wire:model="showPasswordModal" maxWidth="sm">
        <x-slot name="title">
            Actualizar contraseña
        </x-slot>

        <x-slot name="content">
            <!-- password -->
            <div class="col-span-6 sm:col-span-4 mt-4">
                <x-label for="password" value="Contraseña nueva" />
                <x-input id="password" type="text" class="mt-1 block w-full" required autocomplete="password"
                    wire:model='password' />
                <x-input-error for="password" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-button class="ml-3" wire:click="updatePassword()" wire:loading.attr="disabled" class="rounded-md mr-2">
                Guardar
            </x-button>
            <x-secondary-button wire:click="closeChangePassword()" wire:loading.attr="disabled" class="rounded-md">
                Cerrar
            </x-secondary-button>
        </x-slot>
    </x-dialog-modal>

    @include('layouts.delete-confirmation-modal')

</div>
