
@extends('layouts.master')
@section('page-title','Profile & Settings')
@section('content')
    <div class="content-area">

        <div class="mb-large">
            <h2 class="page-title-custom mb-small">
                Profile &amp; settings
            </h2>
            <p class="text-muted text-base-gray">
                Your account, security, and notification preferences
            </p>
        </div>

        @php
            $nameParts = preg_split('/\s+/', trim($user->name ?? ''), 2);
            $firstName = $nameParts[0] ?? '';
            $lastName = $nameParts[1] ?? '';
        @endphp

        <div class="row g-4">

            <!-- Personal Profile Card -->
            <div class="col-md-6">
                <div class="panel border rounded-box-padded">

                    <h4 class="font-weight-bold section-title-margin">
                        Personal profile
                    </h4>

                    <form id="profile-update-form"
                          method="POST"
                          action="{{ route('profile.update') }}">

                        @csrf
                        @method('PATCH')

                        <div class="profile-card-col">

                            <!-- First Name -->
                            <div class="profile-form-group">
                                <label for="first_name"
                                       class="profile-form-label">
                                    First name
                                </label>

                                <input
                                    id="first_name"
                                    class="profile-form-input"
                                    type="text"
                                    value="{{ old('first_name', $firstName) }}"
                                    required
                                    autocomplete="given-name"
                                />

                                @error('name')
                                    <p class="text-danger text-sm mt-1">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Last Name -->
                            <div class="profile-form-group">
                                <label for="last_name"
                                       class="profile-form-label">
                                    Last name
                                </label>

                                <input
                                    id="last_name"
                                    class="profile-form-input"
                                    type="text"
                                    value="{{ old('last_name', $lastName) }}"
                                    autocomplete="family-name"
                                />
                            </div>

                            <!-- Combined name sent to Laravel -->
                            <input
                                type="hidden"
                                name="name"
                                id="full_name"
                                value="{{ old('name', $user->name) }}"
                            />

                            <!-- Email -->
                            <div class="profile-form-group">
                                <label for="email"
                                       class="profile-form-label">
                                    Email
                                </label>

                                <input
                                    id="email"
                                    name="email"
                                    class="profile-form-input"
                                    type="email"
                                    value="{{ old('email', $user->email) }}"
                                    required
                                    autocomplete="username"
                                />

                                @error('email')
                                    <p class="text-danger text-sm mt-1">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Phone -->
                            {{-- <div class="profile-form-group">
                                <label for="phone"
                                       class="profile-form-label">
                                    Phone
                                </label>

                                <input
                                    id="phone"
                                    name="phone"
                                    class="profile-form-input"
                                    type="tel"
                                    value="{{ old('phone', $user->phone ?? '') }}"
                                    autocomplete="tel"
                                />

                                @error('phone')
                                    <p class="text-danger text-sm mt-1">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div> --}}

                            <div class="action-buttons-right">
                                <button
                                    type="submit"
                                    class="btn-solid-action">
                                    Save profile
                                </button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>

            <!-- Change Password Card -->
            <div class="col-md-6">

                <div class="panel border rounded-box-padded">

                    <h4 class="font-weight-bold section-title-margin">
                        Change password
                    </h4>

                    <form method="POST"
                          action="{{ route('password.update') }}"
                          class="profile-card-col">

                        @csrf
                        @method('PUT')

                        <!-- Current Password -->
                        <div class="profile-form-group">
                            <label for="current_password"
                                   class="profile-form-label">
                                Current password
                            </label>

                            <input
                                id="current_password"
                                name="current_password"
                                class="profile-form-input"
                                placeholder="Enter current password"
                                type="password"
                                autocomplete="current-password"
                                required
                            />

                            @error('current_password', 'updatePassword')
                                <p class="text-danger text-sm mt-1">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- New Password -->
                        <div class="profile-form-group">
                            <label for="new_password"
                                   class="profile-form-label">
                                New password
                            </label>

                            <input
                                id="new_password"
                                name="password"
                                class="profile-form-input"
                                placeholder="Enter new password"
                                type="password"
                                autocomplete="new-password"
                                required
                            />

                            @error('password', 'updatePassword')
                                <p class="text-danger text-sm mt-1">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="profile-form-group">
                            <label for="password_confirmation"
                                   class="profile-form-label">
                                Confirm new password
                            </label>

                            <input
                                id="password_confirmation"
                                name="password_confirmation"
                                class="profile-form-input"
                                placeholder="Confirm new password"
                                type="password"
                                autocomplete="new-password"
                                required
                            />

                            @error('password_confirmation', 'updatePassword')
                                <p class="text-danger text-sm mt-1">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <button type="submit" class="btn-update-password">
                            <i class="fi-rs-key"></i>
                            Update password
                        </button>

                        @if (session('status') === 'password-updated')
                            <p class="text-success text-sm mt-2">
                                Password updated successfully.
                            </p>
                        @endif

                    </form>
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons-right">
                    <a class="btn-outline-action text-decoration-none"
                       href="{{ route('dashboard') }}">
                        Back
                    </a>
                </div>

            </div>
        </div>

        @if (session('status') === 'profile-updated')
            <p class="text-success text-sm mt-3">
                Profile updated successfully.
            </p>
        @endif

    </div>

    <!-- Combine first and last name for existing Laravel profile.update -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('profile-update-form');
            const firstName = document.getElementById('first_name');
            const lastName = document.getElementById('last_name');
            const fullName = document.getElementById('full_name');

            form.addEventListener('submit', function () {
                fullName.value = [
                    firstName.value.trim(),
                    lastName.value.trim()
                ].filter(Boolean).join(' ');
            });
        });
    </script>
@endsection
