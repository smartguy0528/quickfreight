<?php

namespace App\Classes;

/**
 * Class VCode
 */
class VCode {
    /**
     * Generate Verify Code
     * 
     */
    public function generateCode() {
        return sprintf("%06d", mt_rand(1, 999999));
    }
}