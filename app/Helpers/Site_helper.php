<?php
    function getMoneyFormat($currency, $value) {
        return $currency.number_format($value, 2,".",',');
    }

    function socialNetworkIcon($type) {
        $icon = "";
        switch ($type) {

            case 'Google':
                $icon = '<img src="'.base_url('public/assets/media/svg/brand-logos/google-icon.svg').'" class="w-30px me-6" alt="logo">';
                break;

            case 'Facebook':
                $icon = '<img src="'.base_url('public/assets/media/svg/brand-logos/facebook-4.svg').'" class="w-30px me-6" alt="logo">';
                break; 

            case 'Twitter':
                $icon = '<img src="'.base_url('public/assets/media/svg/brand-logos/twitter.svg').'" class="w-30px me-6" alt="logo">';
                break;

            case 'LinkedIn':
                $icon = '<img src="'.base_url('public/assets/media/svg/brand-logos/linkedin-1.svg').'" class="w-30px me-6" alt="logo">';
                break;
        }

        return $icon;
    }