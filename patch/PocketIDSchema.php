<?php

namespace App\Extensions\OAuth\Schemas;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\TextInput;
use SocialiteProviders\PocketID\Provider;

final class PocketIDSchema extends OAuthSchema
{
    public function getId(): string
    {
        return 'pocketid';
    }

    public function getSocialiteProvider(): string
    {
        return Provider::class;
    }

    public function getServiceConfig(): array
    {
        return [
            'base_url' => env('OAUTH_POCKETID_BASE_URL'),
            'client_id' => env('OAUTH_POCKETID_CLIENT_ID'),
            'client_secret' => env('OAUTH_POCKETID_CLIENT_SECRET'),
        ];
    }

    public function getSettingsForm(): array
    {
        return array_merge(parent::getSettingsForm(), [
            TextInput::make('OAUTH_POCKETID_BASE_URL')
                ->label('Base URL')
                ->placeholder('Base URL')
                ->columnSpan(2)
                ->required()
                ->url()
                ->autocomplete(false)
                ->default(env('OAUTH_POCKETID_BASE_URL')),
            TextInput::make('OAUTH_POCKETID_DISPLAY_NAME')
                ->label('Display Name')
                ->placeholder('Pocket ID')
                ->autocomplete(false)
                ->default(env('OAUTH_POCKETID_DISPLAY_NAME', 'Pocket ID')),
            ColorPicker::make('OAUTH_POCKETID_DISPLAY_COLOR')
                ->label('Display Color')
                ->placeholder('#000000')
                ->default(env('OAUTH_POCKETID_DISPLAY_COLOR', '#000000'))
                ->hex(),
        ]);
    }

    public function getName(): string
    {
        return env('OAUTH_POCKETID_DISPLAY_NAME', 'Pocket ID');
    }

    public function getHexColor(): string
    {
        return env('OAUTH_POCKETID_DISPLAY_COLOR', '#000000');
    }
}


