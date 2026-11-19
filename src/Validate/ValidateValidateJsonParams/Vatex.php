<?php

declare(strict_types=1);

namespace EInvoiceAPI\Validate\ValidateValidateJsonParams;

/**
 * VATEX code list for VAT exemption reasons.
 *
 * Agency: CEF
 * Identifier: vatex
 */
enum Vatex: string
{
    case VATEX_EU_79_C = 'VATEX-EU-79-C';

    case VATEX_EU_132 = 'VATEX-EU-132';

    case VATEX_EU_132_1_A = 'VATEX-EU-132-1A';

    case VATEX_EU_132_1_B = 'VATEX-EU-132-1B';

    case VATEX_EU_132_1_C = 'VATEX-EU-132-1C';

    case VATEX_EU_132_1_D = 'VATEX-EU-132-1D';

    case VATEX_EU_132_1_E = 'VATEX-EU-132-1E';

    case VATEX_EU_132_1_F = 'VATEX-EU-132-1F';

    case VATEX_EU_132_1_G = 'VATEX-EU-132-1G';

    case VATEX_EU_132_1_H = 'VATEX-EU-132-1H';

    case VATEX_EU_132_1_I = 'VATEX-EU-132-1I';

    case VATEX_EU_132_1_J = 'VATEX-EU-132-1J';

    case VATEX_EU_132_1_K = 'VATEX-EU-132-1K';

    case VATEX_EU_132_1_L = 'VATEX-EU-132-1L';

    case VATEX_EU_132_1_M = 'VATEX-EU-132-1M';

    case VATEX_EU_132_1_N = 'VATEX-EU-132-1N';

    case VATEX_EU_132_1_O = 'VATEX-EU-132-1O';

    case VATEX_EU_132_1_P = 'VATEX-EU-132-1P';

    case VATEX_EU_132_1_Q = 'VATEX-EU-132-1Q';

    case VATEX_EU_135_1 = 'VATEX-EU-135-1';

    case VATEX_EU_143 = 'VATEX-EU-143';

    case VATEX_EU_143_1_A = 'VATEX-EU-143-1A';

    case VATEX_EU_143_1_B = 'VATEX-EU-143-1B';

    case VATEX_EU_143_1_C = 'VATEX-EU-143-1C';

    case VATEX_EU_143_1_D = 'VATEX-EU-143-1D';

    case VATEX_EU_143_1_E = 'VATEX-EU-143-1E';

    case VATEX_EU_143_1_F = 'VATEX-EU-143-1F';

    case VATEX_EU_143_1_FA = 'VATEX-EU-143-1FA';

    case VATEX_EU_143_1_G = 'VATEX-EU-143-1G';

    case VATEX_EU_143_1_H = 'VATEX-EU-143-1H';

    case VATEX_EU_143_1_I = 'VATEX-EU-143-1I';

    case VATEX_EU_143_1_J = 'VATEX-EU-143-1J';

    case VATEX_EU_143_1_K = 'VATEX-EU-143-1K';

    case VATEX_EU_143_1_L = 'VATEX-EU-143-1L';

    case VATEX_EU_144 = 'VATEX-EU-144';

    case VATEX_EU_146_1_E = 'VATEX-EU-146-1E';

    case VATEX_EU_148 = 'VATEX-EU-148';

    case VATEX_EU_148_A = 'VATEX-EU-148-A';

    case VATEX_EU_148_B = 'VATEX-EU-148-B';

    case VATEX_EU_148_C = 'VATEX-EU-148-C';

    case VATEX_EU_148_D = 'VATEX-EU-148-D';

    case VATEX_EU_148_E = 'VATEX-EU-148-E';

    case VATEX_EU_148_F = 'VATEX-EU-148-F';

    case VATEX_EU_148_G = 'VATEX-EU-148-G';

    case VATEX_EU_151 = 'VATEX-EU-151';

    case VATEX_EU_151_1_A = 'VATEX-EU-151-1A';

    case VATEX_EU_151_1_AA = 'VATEX-EU-151-1AA';

    case VATEX_EU_151_1_B = 'VATEX-EU-151-1B';

    case VATEX_EU_151_1_C = 'VATEX-EU-151-1C';

    case VATEX_EU_151_1_D = 'VATEX-EU-151-1D';

    case VATEX_EU_151_1_E = 'VATEX-EU-151-1E';

    case VATEX_EU_153 = 'VATEX-EU-153';

    case VATEX_EU_159 = 'VATEX-EU-159';

    case VATEX_EU_309 = 'VATEX-EU-309';

    case VATEX_EU_AE = 'VATEX-EU-AE';

    case VATEX_EU_D = 'VATEX-EU-D';

    case VATEX_EU_F = 'VATEX-EU-F';

    case VATEX_EU_G = 'VATEX-EU-G';

    case VATEX_EU_I = 'VATEX-EU-I';

    case VATEX_EU_IC = 'VATEX-EU-IC';

    case VATEX_EU_O = 'VATEX-EU-O';

    case VATEX_EU_J = 'VATEX-EU-J';

    case VATEX_FR_298_SEXDECIESA = 'VATEX-FR-298SEXDECIESA';

    case VATEX_FR_AE = 'VATEX-FR-AE';

    case VATEX_FR_CGI261_1 = 'VATEX-FR-CGI261-1';

    case VATEX_FR_CGI261_2 = 'VATEX-FR-CGI261-2';

    case VATEX_FR_CGI261_3 = 'VATEX-FR-CGI261-3';

    case VATEX_FR_CGI261_4 = 'VATEX-FR-CGI261-4';

    case VATEX_FR_CGI261_5 = 'VATEX-FR-CGI261-5';

    case VATEX_FR_CGI261_7 = 'VATEX-FR-CGI261-7';

    case VATEX_FR_CGI261_8 = 'VATEX-FR-CGI261-8';

    case VATEX_FR_CGI261_A = 'VATEX-FR-CGI261A';

    case VATEX_FR_CGI261_B = 'VATEX-FR-CGI261B';

    case VATEX_FR_CGI261_C_1 = 'VATEX-FR-CGI261C-1';

    case VATEX_FR_CGI261_C_2 = 'VATEX-FR-CGI261C-2';

    case VATEX_FR_CGI261_C_3 = 'VATEX-FR-CGI261C-3';

    case VATEX_FR_CGI261_D_1 = 'VATEX-FR-CGI261D-1';

    case VATEX_FR_CGI261_D_1_BIS = 'VATEX-FR-CGI261D-1BIS';

    case VATEX_FR_CGI261_D_2 = 'VATEX-FR-CGI261D-2';

    case VATEX_FR_CGI261_D_3 = 'VATEX-FR-CGI261D-3';

    case VATEX_FR_CGI261_D_4 = 'VATEX-FR-CGI261D-4';

    case VATEX_FR_CGI261_E_1 = 'VATEX-FR-CGI261E-1';

    case VATEX_FR_CGI261_E_2 = 'VATEX-FR-CGI261E-2';

    case VATEX_FR_CGI275 = 'VATEX-FR-CGI275';

    case VATEX_FR_CGI277_A = 'VATEX-FR-CGI277A';

    case VATEX_FR_CGI295 = 'VATEX-FR-CGI295';

    case VATEX_FR_FRANCHISE = 'VATEX-FR-FRANCHISE';

    case VATEX_FR_CNWVAT = 'VATEX-FR-CNWVAT';
}
