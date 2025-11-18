<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents;

/**
 * Unit of Measure Codes from UNECERec20 used in Peppol BIS Billing 3.0.
 */
enum UnitOfMeasureCode: string
{
    case _10 = '10';

    case _11 = '11';

    case _13 = '13';

    case _14 = '14';

    case _15 = '15';

    case _20 = '20';

    case _21 = '21';

    case _22 = '22';

    case _23 = '23';

    case _24 = '24';

    case _25 = '25';

    case _27 = '27';

    case _28 = '28';

    case _33 = '33';

    case _34 = '34';

    case _35 = '35';

    case _37 = '37';

    case _38 = '38';

    case _40 = '40';

    case _41 = '41';

    case _56 = '56';

    case _57 = '57';

    case _58 = '58';

    case _59 = '59';

    case _60 = '60';

    case _61 = '61';

    case _74 = '74';

    case _77 = '77';

    case _80 = '80';

    case _81 = '81';

    case _85 = '85';

    case _87 = '87';

    case _89 = '89';

    case _91 = '91';

    case _1_I = '1I';

    case EA = 'EA';

    case E01 = 'E01';

    case E07 = 'E07';

    case E09 = 'E09';

    case E10 = 'E10';

    case E12 = 'E12';

    case E14 = 'E14';

    case E17 = 'E17';

    case E20 = 'E20';

    case E23 = 'E23';

    case E25 = 'E25';

    case E27 = 'E27';

    case E31 = 'E31';

    case E34 = 'E34';

    case E35 = 'E35';

    case E36 = 'E36';

    case E37 = 'E37';

    case E38 = 'E38';

    case E39 = 'E39';

    case E40 = 'E40';

    case E41 = 'E41';

    case E42 = 'E42';

    case E43 = 'E43';

    case E44 = 'E44';

    case E45 = 'E45';

    case E46 = 'E46';

    case E47 = 'E47';

    case E48 = 'E48';

    case E49 = 'E49';

    case E50 = 'E50';

    case E51 = 'E51';

    case E52 = 'E52';

    case E53 = 'E53';

    case E54 = 'E54';

    case E55 = 'E55';

    case E56 = 'E56';

    case E57 = 'E57';

    case E58 = 'E58';

    case E60 = 'E60';

    case E62 = 'E62';

    case E65 = 'E65';

    case E66 = 'E66';

    case E67 = 'E67';

    case E69 = 'E69';

    case E70 = 'E70';

    case E71 = 'E71';

    case E73 = 'E73';

    case E75 = 'E75';

    case E76 = 'E76';

    case _2_A = '2A';

    case _2_B = '2B';

    case _2_C = '2C';

    case _2_G = '2G';

    case _2_H = '2H';

    case _2_I = '2I';

    case _2_J = '2J';

    case _2_K = '2K';

    case _2_L = '2L';

    case _2_M = '2M';

    case _2_N = '2N';

    case _2_P = '2P';

    case _2_Q = '2Q';

    case _2_R = '2R';

    case _2_U = '2U';

    case _2_X = '2X';

    case _2_Y = '2Y';

    case _2_Z = '2Z';

    case _3_B = '3B';

    case _3_C = '3C';

    case _4_C = '4C';

    case _4_G = '4G';

    case _4_H = '4H';

    case _4_K = '4K';

    case _4_L = '4L';

    case _4_M = '4M';

    case _4_N = '4N';

    case _4_O = '4O';

    case _4_P = '4P';

    case _4_Q = '4Q';

    case _4_R = '4R';

    case _4_T = '4T';

    case _4_U = '4U';

    case _4_W = '4W';

    case _4_X = '4X';

    case _5_A = '5A';

    case _5_B = '5B';

    case _5_E = '5E';

    case _5_J = '5J';

    case A10 = 'A10';

    case A11 = 'A11';

    case A12 = 'A12';

    case A13 = 'A13';

    case A14 = 'A14';

    case A15 = 'A15';

    case A16 = 'A16';

    case A17 = 'A17';

    case A18 = 'A18';

    case A19 = 'A19';

    case A2 = 'A2';

    case A20 = 'A20';

    case A21 = 'A21';

    case A22 = 'A22';

    case A23 = 'A23';

    case A24 = 'A24';

    case A26 = 'A26';

    case A27 = 'A27';

    case A28 = 'A28';

    case A29 = 'A29';

    case A3 = 'A3';

    case A30 = 'A30';

    case A31 = 'A31';

    case A32 = 'A32';

    case A33 = 'A33';

    case A34 = 'A34';

    case A35 = 'A35';

    case A36 = 'A36';

    case A37 = 'A37';

    case A38 = 'A38';

    case A39 = 'A39';

    case A4 = 'A4';

    case A40 = 'A40';

    case A41 = 'A41';

    case A42 = 'A42';

    case A43 = 'A43';

    case A44 = 'A44';

    case A45 = 'A45';

    case A46 = 'A46';

    case A47 = 'A47';

    case A48 = 'A48';

    case A49 = 'A49';

    case A5 = 'A5';

    case A50 = 'A50';

    case A51 = 'A51';

    case A52 = 'A52';

    case A53 = 'A53';

    case A54 = 'A54';

    case A55 = 'A55';

    case A56 = 'A56';

    case A57 = 'A57';

    case A58 = 'A58';

    case A59 = 'A59';

    case A6 = 'A6';

    case A60 = 'A60';

    case A61 = 'A61';

    case A62 = 'A62';

    case A63 = 'A63';

    case A64 = 'A64';

    case A65 = 'A65';

    case A66 = 'A66';

    case A67 = 'A67';

    case A68 = 'A68';

    case A69 = 'A69';

    case A7 = 'A7';

    case A70 = 'A70';

    case A71 = 'A71';

    case A72 = 'A72';

    case A73 = 'A73';

    case A74 = 'A74';

    case A75 = 'A75';

    case A76 = 'A76';

    case A77 = 'A77';

    case A78 = 'A78';

    case A79 = 'A79';

    case A8 = 'A8';

    case A80 = 'A80';

    case A81 = 'A81';

    case A82 = 'A82';

    case A83 = 'A83';

    case A84 = 'A84';

    case A85 = 'A85';

    case A86 = 'A86';

    case A87 = 'A87';

    case A88 = 'A88';

    case A89 = 'A89';

    case A9 = 'A9';

    case A90 = 'A90';

    case A91 = 'A91';

    case A92 = 'A92';

    case A93 = 'A93';

    case A94 = 'A94';

    case A95 = 'A95';

    case A96 = 'A96';

    case A97 = 'A97';

    case A98 = 'A98';

    case A99 = 'A99';

    case ACR = 'ACR';

    case AH = 'AH';

    case AI = 'AI';

    case AK = 'AK';

    case AMH = 'AMH';

    case AMT = 'AMT';

    case ANN = 'ANN';

    case B1 = 'B1';

    case B11 = 'B11';

    case B12 = 'B12';

    case B13 = 'B13';

    case B14 = 'B14';

    case B15 = 'B15';

    case B16 = 'B16';

    case B17 = 'B17';

    case B18 = 'B18';

    case B19 = 'B19';

    case B20 = 'B20';

    case B21 = 'B21';

    case B22 = 'B22';

    case B23 = 'B23';

    case B24 = 'B24';

    case B25 = 'B25';

    case B26 = 'B26';

    case B27 = 'B27';

    case B28 = 'B28';

    case B29 = 'B29';

    case B3 = 'B3';

    case B30 = 'B30';

    case B31 = 'B31';

    case B32 = 'B32';

    case B33 = 'B33';

    case B34 = 'B34';

    case B35 = 'B35';

    case B36 = 'B36';

    case B37 = 'B37';

    case B38 = 'B38';

    case B39 = 'B39';

    case B4 = 'B4';

    case B40 = 'B40';

    case B41 = 'B41';

    case B42 = 'B42';

    case B43 = 'B43';

    case B44 = 'B44';

    case B45 = 'B45';

    case B46 = 'B46';

    case B47 = 'B47';

    case B48 = 'B48';

    case B49 = 'B49';

    case B5 = 'B5';

    case B50 = 'B50';

    case B52 = 'B52';

    case B53 = 'B53';

    case B54 = 'B54';

    case B55 = 'B55';

    case B56 = 'B56';

    case B57 = 'B57';

    case B58 = 'B58';

    case B59 = 'B59';

    case B6 = 'B6';

    case B60 = 'B60';

    case B61 = 'B61';

    case B62 = 'B62';

    case B63 = 'B63';

    case B64 = 'B64';

    case B65 = 'B65';

    case B66 = 'B66';

    case B67 = 'B67';

    case B68 = 'B68';

    case B69 = 'B69';

    case B7 = 'B7';

    case B70 = 'B70';

    case B71 = 'B71';

    case B72 = 'B72';

    case B73 = 'B73';

    case B74 = 'B74';

    case B75 = 'B75';

    case B76 = 'B76';

    case B77 = 'B77';

    case B78 = 'B78';

    case B79 = 'B79';

    case B8 = 'B8';

    case B80 = 'B80';

    case B81 = 'B81';

    case B82 = 'B82';

    case B83 = 'B83';

    case B84 = 'B84';

    case B85 = 'B85';

    case B86 = 'B86';

    case B87 = 'B87';

    case B88 = 'B88';

    case B89 = 'B89';

    case B9 = 'B9';

    case B90 = 'B90';

    case B91 = 'B91';

    case B92 = 'B92';

    case B93 = 'B93';

    case B94 = 'B94';

    case B95 = 'B95';

    case B96 = 'B96';

    case B97 = 'B97';

    case B98 = 'B98';

    case B99 = 'B99';

    case BAR = 'BAR';

    case BB = 'BB';

    case BFT = 'BFT';

    case BHP = 'BHP';

    case BIL = 'BIL';

    case BLD = 'BLD';

    case BLL = 'BLL';

    case BUA = 'BUA';

    case BUI = 'BUI';

    case C0 = 'C0';

    case C10 = 'C10';

    case C11 = 'C11';

    case C12 = 'C12';

    case C13 = 'C13';

    case C14 = 'C14';

    case C15 = 'C15';

    case C16 = 'C16';

    case C17 = 'C17';

    case C18 = 'C18';

    case C19 = 'C19';

    case C20 = 'C20';

    case C21 = 'C21';

    case C22 = 'C22';

    case C23 = 'C23';

    case C24 = 'C24';

    case C25 = 'C25';

    case C26 = 'C26';

    case C27 = 'C27';

    case C28 = 'C28';

    case C29 = 'C29';

    case C30 = 'C30';

    case C31 = 'C31';

    case C32 = 'C32';

    case C33 = 'C33';

    case C34 = 'C34';

    case C35 = 'C35';

    case C36 = 'C36';

    case C37 = 'C37';

    case C38 = 'C38';

    case C39 = 'C39';

    case C40 = 'C40';

    case C41 = 'C41';

    case C42 = 'C42';

    case C43 = 'C43';

    case C44 = 'C44';

    case C45 = 'C45';

    case C46 = 'C46';

    case C47 = 'C47';

    case C48 = 'C48';

    case C49 = 'C49';

    case C50 = 'C50';

    case C51 = 'C51';

    case C52 = 'C52';

    case C53 = 'C53';

    case C54 = 'C54';

    case C55 = 'C55';

    case C56 = 'C56';

    case C57 = 'C57';

    case C58 = 'C58';

    case C59 = 'C59';

    case C60 = 'C60';

    case C61 = 'C61';

    case C63 = 'C63';

    case C64 = 'C64';

    case C65 = 'C65';

    case C66 = 'C66';

    case C67 = 'C67';

    case C68 = 'C68';

    case C69 = 'C69';

    case C70 = 'C70';

    case C71 = 'C71';

    case C72 = 'C72';

    case C73 = 'C73';

    case C74 = 'C74';

    case C75 = 'C75';

    case C76 = 'C76';

    case C77 = 'C77';

    case C78 = 'C78';

    case C79 = 'C79';

    case C80 = 'C80';

    case C81 = 'C81';

    case C82 = 'C82';

    case C83 = 'C83';

    case C84 = 'C84';

    case C85 = 'C85';

    case C86 = 'C86';

    case C87 = 'C87';

    case C88 = 'C88';

    case C89 = 'C89';

    case C90 = 'C90';

    case C91 = 'C91';

    case C92 = 'C92';

    case C93 = 'C93';

    case C94 = 'C94';

    case C95 = 'C95';

    case C96 = 'C96';

    case C97 = 'C97';

    case C98 = 'C98';

    case C99 = 'C99';

    case CDL = 'CDL';

    case CEL = 'CEL';

    case CHU = 'CHU';

    case CIU = 'CIU';

    case CLT = 'CLT';

    case CMK = 'CMK';

    case CMQ = 'CMQ';

    case CMT = 'CMT';

    case CNP = 'CNP';

    case CNT = 'CNT';

    case COU = 'COU';

    case CTG = 'CTG';

    case CTN = 'CTN';

    case CUR = 'CUR';

    case CWA = 'CWA';

    case CWI = 'CWI';

    case DAN = 'DAN';

    case DAY = 'DAY';

    case DB = 'DB';

    case DD = 'DD';

    case DG = 'DG';

    case DI = 'DI';

    case DLT = 'DLT';

    case DMK = 'DMK';

    case DMQ = 'DMQ';

    case DMT = 'DMT';

    case DPC = 'DPC';

    case DPT = 'DPT';

    case DRA = 'DRA';

    case DZN = 'DZN';

    case DZP = 'DZP';

    case FOT = 'FOT';

    case GLL = 'GLL';

    case GLI = 'GLI';

    case GRM = 'GRM';

    case GRO = 'GRO';

    case HUR = 'HUR';

    case HTZ = 'HTZ';

    case INH = 'INH';

    case KGM = 'KGM';

    case KMT = 'KMT';

    case MTR = 'MTR';

    case SMI = 'SMI';

    case MIN = 'MIN';

    case MON = 'MON';

    case ONZ = 'ONZ';

    case LBR = 'LBR';

    case QT = 'QT';

    case SEC = 'SEC';

    case FTK = 'FTK';

    case INK = 'INK';

    case MTK = 'MTK';

    case YDK = 'YDK';

    case TNE = 'TNE';

    case VLT = 'VLT';

    case WTT = 'WTT';

    case YRD = 'YRD';

    case FTQ = 'FTQ';

    case INQ = 'INQ';

    case MTQ = 'MTQ';

    case YDQ = 'YDQ';

    case HAR = 'HAR';

    case KLT = 'KLT';

    case MLT = 'MLT';

    case MMT = 'MMT';

    case KMK = 'KMK';

    case MMK = 'MMK';

    case XAA = 'XAA';

    case XAB = 'XAB';

    case XAC = 'XAC';

    case XAD = 'XAD';

    case XAE = 'XAE';

    case XAF = 'XAF';

    case XAG = 'XAG';

    case XAH = 'XAH';

    case XAI = 'XAI';

    case XAJ = 'XAJ';

    case XAL = 'XAL';

    case XAM = 'XAM';

    case XAP = 'XAP';

    case XAT = 'XAT';

    case XAV = 'XAV';

    case XB4 = 'XB4';

    case XBA = 'XBA';

    case XBB = 'XBB';

    case XBC = 'XBC';

    case XBD = 'XBD';

    case XBE = 'XBE';

    case XBF = 'XBF';

    case XBG = 'XBG';

    case XBH = 'XBH';

    case XBI = 'XBI';

    case XBJ = 'XBJ';

    case XBK = 'XBK';

    case XBL = 'XBL';

    case XBM = 'XBM';

    case XBN = 'XBN';

    case XBO = 'XBO';

    case XBP = 'XBP';

    case XBQ = 'XBQ';

    case XBR = 'XBR';

    case XBS = 'XBS';

    case XBT = 'XBT';

    case XBU = 'XBU';

    case XBV = 'XBV';

    case XBW = 'XBW';

    case XBX = 'XBX';

    case XBY = 'XBY';

    case XBZ = 'XBZ';

    case XCA = 'XCA';

    case XCB = 'XCB';

    case XCC = 'XCC';

    case XCD = 'XCD';

    case XCE = 'XCE';

    case XCF = 'XCF';

    case XCG = 'XCG';

    case XCH = 'XCH';

    case XCI = 'XCI';

    case XCJ = 'XCJ';

    case XCK = 'XCK';

    case XCL = 'XCL';

    case XCM = 'XCM';

    case XCN = 'XCN';

    case XCO = 'XCO';

    case XCP = 'XCP';

    case XCQ = 'XCQ';

    case XCR = 'XCR';

    case XCS = 'XCS';

    case XCT = 'XCT';

    case XCU = 'XCU';

    case XCV = 'XCV';

    case XCW = 'XCW';

    case XCX = 'XCX';

    case XCY = 'XCY';

    case XCZ = 'XCZ';

    case XDA = 'XDA';

    case XDB = 'XDB';

    case XDC = 'XDC';

    case XDD = 'XDD';

    case XDE = 'XDE';

    case XDF = 'XDF';

    case XDG = 'XDG';

    case XDH = 'XDH';

    case XDI = 'XDI';

    case XDJ = 'XDJ';

    case XDK = 'XDK';

    case XDL = 'XDL';

    case XDM = 'XDM';

    case XDN = 'XDN';

    case XDP = 'XDP';

    case XDQ = 'XDQ';

    case XDR = 'XDR';

    case XDS = 'XDS';

    case XDT = 'XDT';

    case XDU = 'XDU';

    case XDV = 'XDV';

    case XDW = 'XDW';

    case XDX = 'XDX';

    case XDY = 'XDY';

    case XDZ = 'XDZ';

    case XEA = 'XEA';

    case XEB = 'XEB';

    case XEC = 'XEC';

    case XED = 'XED';

    case XEE = 'XEE';

    case XEF = 'XEF';

    case XEG = 'XEG';

    case XEH = 'XEH';

    case XEI = 'XEI';

    case XEJ = 'XEJ';

    case XEK = 'XEK';

    case XEL = 'XEL';

    case XEM = 'XEM';

    case XEN = 'XEN';

    case XEP = 'XEP';

    case XEQ = 'XEQ';

    case XER = 'XER';

    case XES = 'XES';

    case XET = 'XET';

    case XEU = 'XEU';

    case XEV = 'XEV';

    case XEW = 'XEW';

    case XEX = 'XEX';

    case XEY = 'XEY';

    case XFB = 'XFB';

    case XFC = 'XFC';

    case XFD = 'XFD';

    case XFE = 'XFE';

    case XFF = 'XFF';

    case XFG = 'XFG';

    case XFH = 'XFH';

    case XFI = 'XFI';

    case XFJ = 'XFJ';

    case XFK = 'XFK';

    case XFL = 'XFL';

    case XFM = 'XFM';

    case XFN = 'XFN';

    case XFO = 'XFO';

    case XFP = 'XFP';

    case XFQ = 'XFQ';

    case XFR = 'XFR';

    case XFS = 'XFS';

    case XFT = 'XFT';

    case XFU = 'XFU';

    case XFV = 'XFV';

    case XFW = 'XFW';

    case XFX = 'XFX';

    case XFY = 'XFY';

    case XFZ = 'XFZ';

    case XGA = 'XGA';

    case XGB = 'XGB';

    case XGC = 'XGC';

    case XGD = 'XGD';

    case XGE = 'XGE';

    case XGF = 'XGF';

    case XGG = 'XGG';

    case XGH = 'XGH';

    case XGI = 'XGI';

    case XGJ = 'XGJ';

    case XGK = 'XGK';

    case XGL = 'XGL';

    case XGM = 'XGM';

    case XGN = 'XGN';

    case XGO = 'XGO';

    case XGP = 'XGP';

    case XGQ = 'XGQ';

    case XGR = 'XGR';

    case XGS = 'XGS';

    case XGT = 'XGT';

    case XGU = 'XGU';

    case XGV = 'XGV';

    case XGW = 'XGW';

    case XGX = 'XGX';

    case XGY = 'XGY';

    case XGZ = 'XGZ';

    case XHA = 'XHA';

    case XHB = 'XHB';

    case XHC = 'XHC';

    case XHD = 'XHD';

    case XHE = 'XHE';

    case XHF = 'XHF';

    case XHG = 'XHG';

    case XHH = 'XHH';

    case XHI = 'XHI';

    case XHJ = 'XHJ';

    case XHK = 'XHK';

    case XHL = 'XHL';

    case XHM = 'XHM';

    case XHN = 'XHN';

    case XHP = 'XHP';

    case XHQ = 'XHQ';

    case XHR = 'XHR';

    case XHS = 'XHS';

    case XHT = 'XHT';

    case XHU = 'XHU';

    case XHV = 'XHV';

    case XHW = 'XHW';

    case XHX = 'XHX';

    case XHY = 'XHY';

    case XHZ = 'XHZ';

    case XIA = 'XIA';

    case XIB = 'XIB';

    case XIC = 'XIC';

    case XID = 'XID';

    case XIE = 'XIE';

    case XIF = 'XIF';

    case XIG = 'XIG';

    case XIH = 'XIH';

    case XII = 'XII';

    case XIJ = 'XIJ';

    case XIK = 'XIK';

    case XIL = 'XIL';

    case XIM = 'XIM';

    case XIN = 'XIN';

    case XIO = 'XIO';

    case XJA = 'XJA';

    case XJB = 'XJB';

    case XJC = 'XJC';

    case XJD = 'XJD';

    case XJE = 'XJE';

    case XJF = 'XJF';

    case XJG = 'XJG';

    case XJH = 'XJH';

    case XJI = 'XJI';

    case XJJ = 'XJJ';

    case XJK = 'XJK';

    case XJL = 'XJL';

    case XJM = 'XJM';

    case XJN = 'XJN';

    case XJO = 'XJO';

    case XJP = 'XJP';

    case XJQ = 'XJQ';

    case XJR = 'XJR';

    case XJS = 'XJS';

    case XJT = 'XJT';

    case XJU = 'XJU';

    case XJV = 'XJV';

    case XJW = 'XJW';

    case XJX = 'XJX';

    case XJY = 'XJY';

    case XJZ = 'XJZ';

    case XLA = 'XLA';

    case XLB = 'XLB';

    case XLC = 'XLC';

    case XLD = 'XLD';

    case XLE = 'XLE';

    case XLF = 'XLF';

    case XLG = 'XLG';

    case XLH = 'XLH';

    case XLI = 'XLI';

    case XLJ = 'XLJ';

    case XLK = 'XLK';

    case XLL = 'XLL';

    case XLM = 'XLM';

    case XLN = 'XLN';

    case XLO = 'XLO';

    case XLP = 'XLP';

    case XLQ = 'XLQ';

    case XLR = 'XLR';

    case XLS = 'XLS';

    case XLT = 'XLT';

    case XLU = 'XLU';

    case XLV = 'XLV';

    case XLW = 'XLW';

    case XLX = 'XLX';

    case XLY = 'XLY';

    case XLZ = 'XLZ';

    case XMA = 'XMA';

    case XMB = 'XMB';

    case XMC = 'XMC';

    case XMD = 'XMD';

    case XME = 'XME';

    case XMF = 'XMF';

    case XMG = 'XMG';

    case XMH = 'XMH';

    case XMI = 'XMI';

    case XMJ = 'XMJ';

    case XMK = 'XMK';

    case XML = 'XML';

    case XMM = 'XMM';

    case XMN = 'XMN';

    case XMO = 'XMO';

    case XMP = 'XMP';

    case XMQ = 'XMQ';

    case XMR = 'XMR';

    case XMS = 'XMS';

    case XMT = 'XMT';

    case XMU = 'XMU';

    case XMV = 'XMV';

    case XMW = 'XMW';

    case XMX = 'XMX';

    case XMY = 'XMY';

    case XMZ = 'XMZ';

    case XNA = 'XNA';

    case XNB = 'XNB';

    case XNC = 'XNC';

    case XND = 'XND';

    case XNE = 'XNE';

    case XNF = 'XNF';

    case XNG = 'XNG';

    case XNH = 'XNH';

    case XNI = 'XNI';

    case XNJ = 'XNJ';

    case XNK = 'XNK';

    case XNL = 'XNL';

    case XNM = 'XNM';

    case XOA = 'XOA';

    case XOB = 'XOB';

    case XOC = 'XOC';

    case XOD = 'XOD';

    case XOE = 'XOE';

    case XOF = 'XOF';

    case XOG = 'XOG';

    case XOH = 'XOH';

    case XOI = 'XOI';

    case XOJ = 'XOJ';

    case XOK = 'XOK';

    case XOL = 'XOL';

    case XOM = 'XOM';

    case XON = 'XON';

    case XOO = 'XOO';

    case XOP = 'XOP';

    case XOQ = 'XOQ';

    case XOR = 'XOR';

    case XOS = 'XOS';

    case XOT = 'XOT';

    case XOU = 'XOU';

    case XOV = 'XOV';

    case XOW = 'XOW';

    case XOX = 'XOX';

    case XOY = 'XOY';

    case XOZ = 'XOZ';

    case XP1 = 'XP1';

    case XP2 = 'XP2';

    case XP3 = 'XP3';

    case XP4 = 'XP4';

    case XPA = 'XPA';

    case XPB = 'XPB';

    case XPC = 'XPC';

    case XPD = 'XPD';

    case XPE = 'XPE';

    case XPF = 'XPF';

    case XPG = 'XPG';

    case XPH = 'XPH';

    case XPI = 'XPI';

    case XPJ = 'XPJ';

    case XPK = 'XPK';

    case XPL = 'XPL';

    case XPM = 'XPM';

    case XPN = 'XPN';

    case XPO = 'XPO';

    case XPP = 'XPP';

    case XPQ = 'XPQ';

    case XPR = 'XPR';

    case XPS = 'XPS';

    case XPT = 'XPT';

    case XPU = 'XPU';

    case XPV = 'XPV';

    case XPW = 'XPW';

    case XPX = 'XPX';

    case XPY = 'XPY';

    case XPZ = 'XPZ';

    case XQA = 'XQA';

    case XQB = 'XQB';

    case XQC = 'XQC';

    case XQD = 'XQD';

    case XQE = 'XQE';

    case XQF = 'XQF';

    case XQG = 'XQG';

    case XQH = 'XQH';

    case XQI = 'XQI';

    case XQJ = 'XQJ';

    case XQK = 'XQK';

    case XQL = 'XQL';

    case XQM = 'XQM';

    case XQN = 'XQN';

    case XQO = 'XQO';

    case XQP = 'XQP';

    case XQQ = 'XQQ';

    case XQR = 'XQR';

    case XQS = 'XQS';

    case XRD = 'XRD';

    case XRE = 'XRE';

    case XRF = 'XRF';

    case XRG = 'XRG';

    case XRH = 'XRH';

    case XRI = 'XRI';

    case XRJ = 'XRJ';

    case XRK = 'XRK';

    case XRL = 'XRL';

    case XRM = 'XRM';

    case XRN = 'XRN';

    case XRO = 'XRO';

    case XRP = 'XRP';

    case XRQ = 'XRQ';

    case XRR = 'XRR';

    case XRS = 'XRS';

    case XRT = 'XRT';

    case XRU = 'XRU';

    case XRV = 'XRV';

    case XRW = 'XRW';

    case XRX = 'XRX';

    case XRY = 'XRY';

    case XRZ = 'XRZ';

    case XSA = 'XSA';

    case XSB = 'XSB';

    case XSC = 'XSC';

    case XSD = 'XSD';

    case XSE = 'XSE';

    case XSF = 'XSF';

    case XSG = 'XSG';

    case XSH = 'XSH';

    case XSI = 'XSI';

    case XSJ = 'XSJ';

    case XSK = 'XSK';

    case XSL = 'XSL';

    case XSM = 'XSM';

    case XSN = 'XSN';

    case XSO = 'XSO';

    case XSP = 'XSP';

    case XSQ = 'XSQ';

    case XSR = 'XSR';

    case XSS = 'XSS';

    case XST = 'XST';

    case XSU = 'XSU';

    case XSV = 'XSV';

    case XSW = 'XSW';

    case XSX = 'XSX';

    case XSY = 'XSY';

    case XSZ = 'XSZ';

    case XTA = 'XTA';

    case XTB = 'XTB';

    case XTC = 'XTC';

    case XTD = 'XTD';

    case XTE = 'XTE';

    case XTF = 'XTF';

    case XTG = 'XTG';

    case XTI = 'XTI';

    case XTJ = 'XTJ';

    case XTK = 'XTK';

    case XTL = 'XTL';

    case XTM = 'XTM';

    case XTN = 'XTN';

    case XTO = 'XTO';

    case XTR = 'XTR';

    case XTS = 'XTS';

    case XTT = 'XTT';

    case XTU = 'XTU';

    case XTV = 'XTV';

    case XTW = 'XTW';

    case XTX = 'XTX';

    case XTY = 'XTY';

    case XTZ = 'XTZ';

    case XUC = 'XUC';

    case XUN = 'XUN';

    case XVA = 'XVA';

    case XVG = 'XVG';

    case XVI = 'XVI';

    case XVK = 'XVK';

    case XVL = 'XVL';

    case XVN = 'XVN';

    case XVO = 'XVO';

    case XVP = 'XVP';

    case XVQ = 'XVQ';

    case XVR = 'XVR';

    case XVS = 'XVS';

    case XVY = 'XVY';

    case XWA = 'XWA';

    case XWB = 'XWB';

    case XWC = 'XWC';

    case XWD = 'XWD';

    case XWF = 'XWF';

    case XWG = 'XWG';

    case XWH = 'XWH';

    case XWJ = 'XWJ';

    case XWK = 'XWK';

    case XWL = 'XWL';

    case XWM = 'XWM';

    case XWN = 'XWN';

    case XWP = 'XWP';

    case XWQ = 'XWQ';

    case XWR = 'XWR';

    case XWS = 'XWS';

    case XWT = 'XWT';

    case XWU = 'XWU';

    case XWV = 'XWV';

    case XWW = 'XWW';

    case XWX = 'XWX';

    case XWY = 'XWY';

    case XWZ = 'XWZ';

    case XXA = 'XXA';

    case XXB = 'XXB';

    case XXC = 'XXC';

    case XXD = 'XXD';

    case XXF = 'XXF';

    case XXG = 'XXG';

    case XXH = 'XXH';

    case XXJ = 'XXJ';

    case XXK = 'XXK';

    case XYA = 'XYA';

    case XYB = 'XYB';

    case XYC = 'XYC';

    case XYD = 'XYD';

    case XYF = 'XYF';

    case XYG = 'XYG';

    case XYH = 'XYH';

    case XYJ = 'XYJ';

    case XYK = 'XYK';

    case XYL = 'XYL';

    case XYM = 'XYM';

    case XYN = 'XYN';

    case XYP = 'XYP';

    case XYQ = 'XYQ';

    case XYR = 'XYR';

    case XYS = 'XYS';

    case XYT = 'XYT';

    case XYV = 'XYV';

    case XYW = 'XYW';

    case XYX = 'XYX';

    case XYY = 'XYY';

    case XYZ = 'XYZ';

    case XZA = 'XZA';

    case XZB = 'XZB';

    case XZC = 'XZC';

    case XZD = 'XZD';

    case XZF = 'XZF';

    case XZG = 'XZG';

    case XZH = 'XZH';

    case XZJ = 'XZJ';

    case XZK = 'XZK';

    case XZL = 'XZL';

    case XZM = 'XZM';

    case XZN = 'XZN';

    case XZP = 'XZP';

    case XZQ = 'XZQ';

    case XZR = 'XZR';

    case XZS = 'XZS';

    case XZT = 'XZT';

    case XZU = 'XZU';

    case XZV = 'XZV';

    case XZW = 'XZW';

    case XZX = 'XZX';

    case XZY = 'XZY';

    case XZZ = 'XZZ';

    case ZZ = 'ZZ';

    case NAR = 'NAR';

    case C62 = 'C62';

    case LTR = 'LTR';

    case H87 = 'H87';
}
