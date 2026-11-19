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

    case AA = 'AA';

    case AB = 'AB';

    case ACT = 'ACT';

    case AD = 'AD';

    case AE = 'AE';

    case AL = 'AL';

    case AMP = 'AMP';

    case APZ = 'APZ';

    case AQ = 'AQ';

    case AS = 'AS';

    case ASM = 'ASM';

    case ASU = 'ASU';

    case ATM = 'ATM';

    case AWG = 'AWG';

    case AY = 'AY';

    case AZ = 'AZ';

    case B10 = 'B10';

    case BP = 'BP';

    case BPM = 'BPM';

    case BQL = 'BQL';

    case BTU = 'BTU';

    case C3 = 'C3';

    case C7 = 'C7';

    case C8 = 'C8';

    case C9 = 'C9';

    case CCT = 'CCT';

    case CEN = 'CEN';

    case CG = 'CG';

    case CGM = 'CGM';

    case CKG = 'CKG';

    case CLF = 'CLF';

    case CTM = 'CTM';

    case D03 = 'D03';

    case D04 = 'D04';

    case D1 = 'D1';

    case D10 = 'D10';

    case D11 = 'D11';

    case D12 = 'D12';

    case D13 = 'D13';

    case D15 = 'D15';

    case D16 = 'D16';

    case D17 = 'D17';

    case D18 = 'D18';

    case D19 = 'D19';

    case D2 = 'D2';

    case D20 = 'D20';

    case D21 = 'D21';

    case D22 = 'D22';

    case D23 = 'D23';

    case D24 = 'D24';

    case D25 = 'D25';

    case D26 = 'D26';

    case D27 = 'D27';

    case D29 = 'D29';

    case D30 = 'D30';

    case D31 = 'D31';

    case D32 = 'D32';

    case D33 = 'D33';

    case D34 = 'D34';

    case D36 = 'D36';

    case D41 = 'D41';

    case D42 = 'D42';

    case D43 = 'D43';

    case D44 = 'D44';

    case D45 = 'D45';

    case D46 = 'D46';

    case D47 = 'D47';

    case D48 = 'D48';

    case D49 = 'D49';

    case D5 = 'D5';

    case D50 = 'D50';

    case D51 = 'D51';

    case D52 = 'D52';

    case D53 = 'D53';

    case D54 = 'D54';

    case D55 = 'D55';

    case D56 = 'D56';

    case D57 = 'D57';

    case D58 = 'D58';

    case D59 = 'D59';

    case D6 = 'D6';

    case D60 = 'D60';

    case D61 = 'D61';

    case D62 = 'D62';

    case D63 = 'D63';

    case D65 = 'D65';

    case D68 = 'D68';

    case D69 = 'D69';

    case D73 = 'D73';

    case D74 = 'D74';

    case D77 = 'D77';

    case D78 = 'D78';

    case D80 = 'D80';

    case D81 = 'D81';

    case D82 = 'D82';

    case D83 = 'D83';

    case D85 = 'D85';

    case D86 = 'D86';

    case D87 = 'D87';

    case D88 = 'D88';

    case D89 = 'D89';

    case D91 = 'D91';

    case D93 = 'D93';

    case D94 = 'D94';

    case D95 = 'D95';

    case DAA = 'DAA';

    case DAD = 'DAD';

    case DBM = 'DBM';

    case DBW = 'DBW';

    case DEC = 'DEC';

    case DJ = 'DJ';

    case DMA = 'DMA';

    case DMO = 'DMO';

    case DN = 'DN';

    case DPR = 'DPR';

    case DRI = 'DRI';

    case DRL = 'DRL';

    case DT = 'DT';

    case DTN = 'DTN';

    case DWT = 'DWT';

    case E08 = 'E08';

    case E15 = 'E15';

    case E16 = 'E16';

    case E18 = 'E18';

    case E19 = 'E19';

    case E21 = 'E21';

    case E22 = 'E22';

    case E28 = 'E28';

    case E30 = 'E30';

    case E32 = 'E32';

    case E33 = 'E33';

    case E4 = 'E4';

    case E59 = 'E59';

    case E61 = 'E61';

    case E63 = 'E63';

    case E64 = 'E64';

    case E68 = 'E68';

    case E72 = 'E72';

    case E74 = 'E74';

    case E77 = 'E77';

    case E78 = 'E78';

    case E79 = 'E79';

    case E80 = 'E80';

    case E81 = 'E81';

    case E82 = 'E82';

    case E83 = 'E83';

    case E84 = 'E84';

    case E85 = 'E85';

    case E86 = 'E86';

    case E87 = 'E87';

    case E88 = 'E88';

    case E89 = 'E89';

    case E90 = 'E90';

    case E91 = 'E91';

    case E92 = 'E92';

    case E93 = 'E93';

    case E94 = 'E94';

    case E95 = 'E95';

    case E96 = 'E96';

    case E97 = 'E97';

    case E98 = 'E98';

    case E99 = 'E99';

    case EB = 'EB';

    case EQ = 'EQ';

    case F01 = 'F01';

    case F02 = 'F02';

    case F03 = 'F03';

    case F04 = 'F04';

    case F05 = 'F05';

    case F06 = 'F06';

    case F07 = 'F07';

    case F08 = 'F08';

    case F10 = 'F10';

    case F11 = 'F11';

    case F12 = 'F12';

    case F13 = 'F13';

    case F14 = 'F14';

    case F15 = 'F15';

    case F16 = 'F16';

    case F17 = 'F17';

    case F18 = 'F18';

    case F19 = 'F19';

    case F20 = 'F20';

    case F21 = 'F21';

    case F22 = 'F22';

    case F23 = 'F23';

    case F24 = 'F24';

    case F25 = 'F25';

    case F26 = 'F26';

    case F27 = 'F27';

    case F28 = 'F28';

    case F29 = 'F29';

    case F30 = 'F30';

    case F31 = 'F31';

    case F32 = 'F32';

    case F33 = 'F33';

    case F34 = 'F34';

    case F35 = 'F35';

    case F36 = 'F36';

    case F37 = 'F37';

    case F38 = 'F38';

    case F39 = 'F39';

    case F40 = 'F40';

    case F41 = 'F41';

    case F42 = 'F42';

    case F43 = 'F43';

    case F44 = 'F44';

    case F45 = 'F45';

    case F46 = 'F46';

    case F47 = 'F47';

    case F48 = 'F48';

    case F49 = 'F49';

    case F50 = 'F50';

    case F51 = 'F51';

    case F52 = 'F52';

    case F53 = 'F53';

    case F54 = 'F54';

    case F55 = 'F55';

    case F56 = 'F56';

    case F57 = 'F57';

    case F58 = 'F58';

    case F59 = 'F59';

    case F60 = 'F60';

    case F61 = 'F61';

    case F62 = 'F62';

    case F63 = 'F63';

    case F64 = 'F64';

    case F65 = 'F65';

    case F66 = 'F66';

    case F67 = 'F67';

    case F68 = 'F68';

    case F69 = 'F69';

    case F70 = 'F70';

    case F71 = 'F71';

    case F72 = 'F72';

    case F73 = 'F73';

    case F74 = 'F74';

    case F75 = 'F75';

    case F76 = 'F76';

    case F77 = 'F77';

    case F78 = 'F78';

    case F79 = 'F79';

    case F80 = 'F80';

    case F81 = 'F81';

    case F82 = 'F82';

    case F83 = 'F83';

    case F84 = 'F84';

    case F85 = 'F85';

    case F86 = 'F86';

    case F87 = 'F87';

    case F88 = 'F88';

    case F89 = 'F89';

    case F90 = 'F90';

    case F91 = 'F91';

    case F92 = 'F92';

    case F93 = 'F93';

    case F94 = 'F94';

    case F95 = 'F95';

    case F96 = 'F96';

    case F97 = 'F97';

    case F98 = 'F98';

    case F99 = 'F99';

    case FAH = 'FAH';

    case FAR = 'FAR';

    case FBM = 'FBM';

    case FC = 'FC';

    case FF = 'FF';

    case FH = 'FH';

    case FIT = 'FIT';

    case FL = 'FL';

    case FNU = 'FNU';

    case FP = 'FP';

    case FR = 'FR';

    case FS = 'FS';

    case G01 = 'G01';

    case G04 = 'G04';

    case G05 = 'G05';

    case G06 = 'G06';

    case G08 = 'G08';

    case G09 = 'G09';

    case G10 = 'G10';

    case G11 = 'G11';

    case G12 = 'G12';

    case G13 = 'G13';

    case G14 = 'G14';

    case G15 = 'G15';

    case G16 = 'G16';

    case G17 = 'G17';

    case G18 = 'G18';

    case G19 = 'G19';

    case G2 = 'G2';

    case G20 = 'G20';

    case G21 = 'G21';

    case G23 = 'G23';

    case G24 = 'G24';

    case G25 = 'G25';

    case G26 = 'G26';

    case G27 = 'G27';

    case G28 = 'G28';

    case G29 = 'G29';

    case G3 = 'G3';

    case G30 = 'G30';

    case G31 = 'G31';

    case G32 = 'G32';

    case G33 = 'G33';

    case G34 = 'G34';

    case G35 = 'G35';

    case G36 = 'G36';

    case G37 = 'G37';

    case G38 = 'G38';

    case G39 = 'G39';

    case G40 = 'G40';

    case G41 = 'G41';

    case G42 = 'G42';

    case G43 = 'G43';

    case G44 = 'G44';

    case G45 = 'G45';

    case G46 = 'G46';

    case G47 = 'G47';

    case G48 = 'G48';

    case G49 = 'G49';

    case G50 = 'G50';

    case G51 = 'G51';

    case G52 = 'G52';

    case G53 = 'G53';

    case G54 = 'G54';

    case G55 = 'G55';

    case G56 = 'G56';

    case G57 = 'G57';

    case G58 = 'G58';

    case G59 = 'G59';

    case G60 = 'G60';

    case G61 = 'G61';

    case G62 = 'G62';

    case G63 = 'G63';

    case G64 = 'G64';

    case G65 = 'G65';

    case G66 = 'G66';

    case G67 = 'G67';

    case G68 = 'G68';

    case G69 = 'G69';

    case G70 = 'G70';

    case G71 = 'G71';

    case G72 = 'G72';

    case G73 = 'G73';

    case G74 = 'G74';

    case G75 = 'G75';

    case G76 = 'G76';

    case G77 = 'G77';

    case G78 = 'G78';

    case G79 = 'G79';

    case G80 = 'G80';

    case G81 = 'G81';

    case G82 = 'G82';

    case G83 = 'G83';

    case G84 = 'G84';

    case G85 = 'G85';

    case G86 = 'G86';

    case G87 = 'G87';

    case G88 = 'G88';

    case G89 = 'G89';

    case G90 = 'G90';

    case G91 = 'G91';

    case G92 = 'G92';

    case G93 = 'G93';

    case G94 = 'G94';

    case G95 = 'G95';

    case G96 = 'G96';

    case G97 = 'G97';

    case G98 = 'G98';

    case G99 = 'G99';

    case GB = 'GB';

    case GBQ = 'GBQ';

    case GDW = 'GDW';

    case GE = 'GE';

    case GF = 'GF';

    case GFI = 'GFI';

    case GGR = 'GGR';

    case GIA = 'GIA';

    case GIC = 'GIC';

    case GII = 'GII';

    case GIP = 'GIP';

    case GJ = 'GJ';

    case GL = 'GL';

    case GLD = 'GLD';

    case GM = 'GM';

    case GO = 'GO';

    case GP = 'GP';

    case GQ = 'GQ';

    case GRN = 'GRN';

    case GV = 'GV';

    case GWH = 'GWH';

    case H03 = 'H03';

    case H04 = 'H04';

    case H05 = 'H05';

    case H06 = 'H06';

    case H07 = 'H07';

    case H08 = 'H08';

    case H09 = 'H09';

    case H10 = 'H10';

    case H11 = 'H11';

    case H12 = 'H12';

    case H13 = 'H13';

    case H14 = 'H14';

    case H15 = 'H15';

    case H16 = 'H16';

    case H18 = 'H18';

    case H19 = 'H19';

    case H20 = 'H20';

    case H21 = 'H21';

    case H22 = 'H22';

    case H23 = 'H23';

    case H24 = 'H24';

    case H25 = 'H25';

    case H26 = 'H26';

    case H27 = 'H27';

    case H28 = 'H28';

    case H29 = 'H29';

    case H30 = 'H30';

    case H31 = 'H31';

    case H32 = 'H32';

    case H33 = 'H33';

    case H34 = 'H34';

    case H35 = 'H35';

    case H36 = 'H36';

    case H37 = 'H37';

    case H38 = 'H38';

    case H39 = 'H39';

    case H40 = 'H40';

    case H41 = 'H41';

    case H42 = 'H42';

    case H43 = 'H43';

    case H44 = 'H44';

    case H45 = 'H45';

    case H46 = 'H46';

    case H47 = 'H47';

    case H48 = 'H48';

    case H49 = 'H49';

    case H50 = 'H50';

    case H51 = 'H51';

    case H52 = 'H52';

    case H53 = 'H53';

    case H54 = 'H54';

    case H55 = 'H55';

    case H56 = 'H56';

    case H57 = 'H57';

    case H58 = 'H58';

    case H59 = 'H59';

    case H60 = 'H60';

    case H61 = 'H61';

    case H62 = 'H62';

    case H63 = 'H63';

    case H64 = 'H64';

    case H65 = 'H65';

    case H66 = 'H66';

    case H67 = 'H67';

    case H68 = 'H68';

    case H69 = 'H69';

    case H70 = 'H70';

    case H71 = 'H71';

    case H72 = 'H72';

    case H73 = 'H73';

    case H74 = 'H74';

    case H75 = 'H75';

    case H76 = 'H76';

    case H77 = 'H77';

    case H79 = 'H79';

    case H80 = 'H80';

    case H81 = 'H81';

    case H82 = 'H82';

    case H83 = 'H83';

    case H84 = 'H84';

    case H85 = 'H85';

    case H88 = 'H88';

    case H89 = 'H89';

    case H90 = 'H90';

    case H91 = 'H91';

    case H92 = 'H92';

    case H93 = 'H93';

    case H94 = 'H94';

    case H95 = 'H95';

    case H96 = 'H96';

    case H98 = 'H98';

    case H99 = 'H99';

    case HA = 'HA';

    case HAD = 'HAD';

    case HBA = 'HBA';

    case HBX = 'HBX';

    case HC = 'HC';

    case HDW = 'HDW';

    case HEA = 'HEA';

    case HGM = 'HGM';

    case HH = 'HH';

    case HIU = 'HIU';

    case HKM = 'HKM';

    case HLT = 'HLT';

    case HM = 'HM';

    case HMO = 'HMO';

    case HMQ = 'HMQ';

    case HMT = 'HMT';

    case HPA = 'HPA';

    case HWE = 'HWE';

    case IA = 'IA';

    case IE = 'IE';

    case ISD = 'ISD';

    case IU = 'IU';

    case IUG = 'IUG';

    case IV = 'IV';

    case J10 = 'J10';

    case J12 = 'J12';

    case J13 = 'J13';

    case J14 = 'J14';

    case J15 = 'J15';

    case J16 = 'J16';

    case J17 = 'J17';

    case J18 = 'J18';

    case J19 = 'J19';

    case J2 = 'J2';

    case J20 = 'J20';

    case J21 = 'J21';

    case J22 = 'J22';

    case J23 = 'J23';

    case J24 = 'J24';

    case J25 = 'J25';

    case J26 = 'J26';

    case J27 = 'J27';

    case J28 = 'J28';

    case J29 = 'J29';

    case J30 = 'J30';

    case J31 = 'J31';

    case J32 = 'J32';

    case J33 = 'J33';

    case J34 = 'J34';

    case J35 = 'J35';

    case J36 = 'J36';

    case J38 = 'J38';

    case J39 = 'J39';

    case J40 = 'J40';

    case J41 = 'J41';

    case J42 = 'J42';

    case J43 = 'J43';

    case J44 = 'J44';

    case J45 = 'J45';

    case J46 = 'J46';

    case J47 = 'J47';

    case J48 = 'J48';

    case J49 = 'J49';

    case J50 = 'J50';

    case J51 = 'J51';

    case J52 = 'J52';

    case J53 = 'J53';

    case J54 = 'J54';

    case J55 = 'J55';

    case J56 = 'J56';

    case J57 = 'J57';

    case J58 = 'J58';

    case J59 = 'J59';

    case J60 = 'J60';

    case J61 = 'J61';

    case J62 = 'J62';

    case J63 = 'J63';

    case J64 = 'J64';

    case J65 = 'J65';

    case J66 = 'J66';

    case J67 = 'J67';

    case J68 = 'J68';

    case J69 = 'J69';

    case J70 = 'J70';

    case J71 = 'J71';

    case J72 = 'J72';

    case J73 = 'J73';

    case J74 = 'J74';

    case J75 = 'J75';

    case J76 = 'J76';

    case J78 = 'J78';

    case J79 = 'J79';

    case J81 = 'J81';

    case J82 = 'J82';

    case J83 = 'J83';

    case J84 = 'J84';

    case J85 = 'J85';

    case J87 = 'J87';

    case J90 = 'J90';

    case J91 = 'J91';

    case J92 = 'J92';

    case J93 = 'J93';

    case J95 = 'J95';

    case J96 = 'J96';

    case J97 = 'J97';

    case J98 = 'J98';

    case J99 = 'J99';

    case JE = 'JE';

    case JK = 'JK';

    case JM = 'JM';

    case JNT = 'JNT';

    case JOU = 'JOU';

    case JPS = 'JPS';

    case JWL = 'JWL';

    case K1 = 'K1';

    case K10 = 'K10';

    case K11 = 'K11';

    case K12 = 'K12';

    case K13 = 'K13';

    case K14 = 'K14';

    case K15 = 'K15';

    case K16 = 'K16';

    case K17 = 'K17';

    case K18 = 'K18';

    case K19 = 'K19';

    case K2 = 'K2';

    case K20 = 'K20';

    case K21 = 'K21';

    case K22 = 'K22';

    case K23 = 'K23';

    case K26 = 'K26';

    case K27 = 'K27';

    case K28 = 'K28';

    case K3 = 'K3';

    case K30 = 'K30';

    case K31 = 'K31';

    case K32 = 'K32';

    case K33 = 'K33';

    case K34 = 'K34';

    case K35 = 'K35';

    case K36 = 'K36';

    case K37 = 'K37';

    case K38 = 'K38';

    case K39 = 'K39';

    case K40 = 'K40';

    case K41 = 'K41';

    case K42 = 'K42';

    case K43 = 'K43';

    case K45 = 'K45';

    case K46 = 'K46';

    case K47 = 'K47';

    case K48 = 'K48';

    case K49 = 'K49';

    case K50 = 'K50';

    case K51 = 'K51';

    case K52 = 'K52';

    case K53 = 'K53';

    case K54 = 'K54';

    case K55 = 'K55';

    case K58 = 'K58';

    case K59 = 'K59';

    case K6 = 'K6';

    case K60 = 'K60';

    case K61 = 'K61';

    case K62 = 'K62';

    case K63 = 'K63';

    case K64 = 'K64';

    case K65 = 'K65';

    case K66 = 'K66';

    case K67 = 'K67';

    case K68 = 'K68';

    case K69 = 'K69';

    case K70 = 'K70';

    case K71 = 'K71';

    case K73 = 'K73';

    case K74 = 'K74';

    case K75 = 'K75';

    case K76 = 'K76';

    case K77 = 'K77';

    case K78 = 'K78';

    case K79 = 'K79';

    case K80 = 'K80';

    case K81 = 'K81';

    case K82 = 'K82';

    case K83 = 'K83';

    case K84 = 'K84';

    case K85 = 'K85';

    case K86 = 'K86';

    case K87 = 'K87';

    case K88 = 'K88';

    case K89 = 'K89';

    case K90 = 'K90';

    case K91 = 'K91';

    case K92 = 'K92';

    case K93 = 'K93';

    case K94 = 'K94';

    case K95 = 'K95';

    case K96 = 'K96';

    case K97 = 'K97';

    case K98 = 'K98';

    case K99 = 'K99';

    case KA = 'KA';

    case KAT = 'KAT';

    case KB = 'KB';

    case KBA = 'KBA';

    case KCC = 'KCC';

    case KDW = 'KDW';

    case KEL = 'KEL';

    case KGS = 'KGS';

    case KHY = 'KHY';

    case KHZ = 'KHZ';

    case KI = 'KI';

    case KIC = 'KIC';

    case KIP = 'KIP';

    case KJ = 'KJ';

    case KJO = 'KJO';

    case KL = 'KL';

    case KLK = 'KLK';

    case KLX = 'KLX';

    case KMA = 'KMA';

    case KMH = 'KMH';

    case KMQ = 'KMQ';

    case KNI = 'KNI';

    case KNM = 'KNM';

    case KNS = 'KNS';

    case KNT = 'KNT';

    case KO = 'KO';

    case KPA = 'KPA';

    case KPH = 'KPH';

    case KPO = 'KPO';

    case KPP = 'KPP';

    case KR = 'KR';

    case KSD = 'KSD';

    case KSH = 'KSH';

    case KT = 'KT';

    case KTN = 'KTN';

    case KUR = 'KUR';

    case KVA = 'KVA';

    case KVR = 'KVR';

    case KVT = 'KVT';

    case KW = 'KW';

    case KWH = 'KWH';

    case KWN = 'KWN';

    case KWO = 'KWO';

    case KWS = 'KWS';

    case KWT = 'KWT';

    case KWY = 'KWY';

    case KX = 'KX';

    case L10 = 'L10';

    case L11 = 'L11';

    case L12 = 'L12';

    case L13 = 'L13';

    case L14 = 'L14';

    case L15 = 'L15';

    case L16 = 'L16';

    case L17 = 'L17';

    case L18 = 'L18';

    case L19 = 'L19';

    case L2 = 'L2';

    case L20 = 'L20';

    case L21 = 'L21';

    case L23 = 'L23';

    case L24 = 'L24';

    case L25 = 'L25';

    case L26 = 'L26';

    case L27 = 'L27';

    case L28 = 'L28';

    case L29 = 'L29';

    case L30 = 'L30';

    case L31 = 'L31';

    case L32 = 'L32';

    case L33 = 'L33';

    case L34 = 'L34';

    case L35 = 'L35';

    case L36 = 'L36';

    case L37 = 'L37';

    case L38 = 'L38';

    case L39 = 'L39';

    case L40 = 'L40';

    case L41 = 'L41';

    case L42 = 'L42';

    case L43 = 'L43';

    case L44 = 'L44';

    case L45 = 'L45';

    case L46 = 'L46';

    case L47 = 'L47';

    case L48 = 'L48';

    case L49 = 'L49';

    case L50 = 'L50';

    case L51 = 'L51';

    case L52 = 'L52';

    case L53 = 'L53';

    case L54 = 'L54';

    case L55 = 'L55';

    case L56 = 'L56';

    case L57 = 'L57';

    case L58 = 'L58';

    case L59 = 'L59';

    case L60 = 'L60';

    case L63 = 'L63';

    case L64 = 'L64';

    case L65 = 'L65';

    case L66 = 'L66';

    case L67 = 'L67';

    case L68 = 'L68';

    case L69 = 'L69';

    case L70 = 'L70';

    case L71 = 'L71';

    case L72 = 'L72';

    case L73 = 'L73';

    case L74 = 'L74';

    case L75 = 'L75';

    case L76 = 'L76';

    case L77 = 'L77';

    case L78 = 'L78';

    case L79 = 'L79';

    case L80 = 'L80';

    case L81 = 'L81';

    case L82 = 'L82';

    case L83 = 'L83';

    case L84 = 'L84';

    case L85 = 'L85';

    case L86 = 'L86';

    case L87 = 'L87';

    case L88 = 'L88';

    case L89 = 'L89';

    case L90 = 'L90';

    case L91 = 'L91';

    case L92 = 'L92';

    case L93 = 'L93';

    case L94 = 'L94';

    case L95 = 'L95';

    case L96 = 'L96';

    case L98 = 'L98';

    case L99 = 'L99';

    case LA = 'LA';

    case LAC = 'LAC';

    case LBT = 'LBT';

    case LD = 'LD';

    case LEF = 'LEF';

    case LF = 'LF';

    case LH = 'LH';

    case LK = 'LK';

    case LM = 'LM';

    case LN = 'LN';

    case LO = 'LO';

    case LP = 'LP';

    case LPA = 'LPA';

    case LR = 'LR';

    case LS = 'LS';

    case LTN = 'LTN';

    case LUB = 'LUB';

    case LUM = 'LUM';

    case LUX = 'LUX';

    case LY = 'LY';

    case M1 = 'M1';

    case M10 = 'M10';

    case M11 = 'M11';

    case M12 = 'M12';

    case M13 = 'M13';

    case M14 = 'M14';

    case M15 = 'M15';

    case M16 = 'M16';

    case M17 = 'M17';

    case M18 = 'M18';

    case M19 = 'M19';

    case M20 = 'M20';

    case M21 = 'M21';

    case M22 = 'M22';

    case M23 = 'M23';

    case M24 = 'M24';

    case M25 = 'M25';

    case M26 = 'M26';

    case M27 = 'M27';

    case M29 = 'M29';

    case M30 = 'M30';

    case M31 = 'M31';

    case M32 = 'M32';

    case M33 = 'M33';

    case M34 = 'M34';

    case M35 = 'M35';

    case M36 = 'M36';

    case M37 = 'M37';

    case M38 = 'M38';

    case M39 = 'M39';

    case M4 = 'M4';

    case M40 = 'M40';

    case M41 = 'M41';

    case M42 = 'M42';

    case M43 = 'M43';

    case M44 = 'M44';

    case M45 = 'M45';

    case M46 = 'M46';

    case M47 = 'M47';

    case M48 = 'M48';

    case M49 = 'M49';

    case M5 = 'M5';

    case M50 = 'M50';

    case M51 = 'M51';

    case M52 = 'M52';

    case M53 = 'M53';

    case M55 = 'M55';

    case M56 = 'M56';

    case M57 = 'M57';

    case M58 = 'M58';

    case M59 = 'M59';

    case M60 = 'M60';

    case M61 = 'M61';

    case M62 = 'M62';

    case M63 = 'M63';

    case M64 = 'M64';

    case M65 = 'M65';

    case M66 = 'M66';

    case M67 = 'M67';

    case M68 = 'M68';

    case M69 = 'M69';

    case M7 = 'M7';

    case M70 = 'M70';

    case M71 = 'M71';

    case M72 = 'M72';

    case M73 = 'M73';

    case M74 = 'M74';

    case M75 = 'M75';

    case M76 = 'M76';

    case M77 = 'M77';

    case M78 = 'M78';

    case M79 = 'M79';

    case M80 = 'M80';

    case M81 = 'M81';

    case M82 = 'M82';

    case M83 = 'M83';

    case M84 = 'M84';

    case M85 = 'M85';

    case M86 = 'M86';

    case M87 = 'M87';

    case M88 = 'M88';

    case M89 = 'M89';

    case M9 = 'M9';

    case M90 = 'M90';

    case M91 = 'M91';

    case M92 = 'M92';

    case M93 = 'M93';

    case M94 = 'M94';

    case M95 = 'M95';

    case M96 = 'M96';

    case M97 = 'M97';

    case M98 = 'M98';

    case M99 = 'M99';

    case MAH = 'MAH';

    case MAL = 'MAL';

    case MAM = 'MAM';

    case MAR = 'MAR';

    case MAW = 'MAW';

    case MBE = 'MBE';

    case MBF = 'MBF';

    case MBR = 'MBR';

    case MC = 'MC';

    case MCU = 'MCU';

    case MD = 'MD';

    case MGM = 'MGM';

    case MHZ = 'MHZ';

    case MIK = 'MIK';

    case MIL = 'MIL';

    case MIO = 'MIO';

    case MIU = 'MIU';

    case MKD = 'MKD';

    case MKM = 'MKM';

    case MKW = 'MKW';

    case MLD = 'MLD';

    case MMQ = 'MMQ';

    case MND = 'MND';

    case MNJ = 'MNJ';

    case MPA = 'MPA';

    case MQD = 'MQD';

    case MQH = 'MQH';

    case MQM = 'MQM';

    case MQS = 'MQS';

    case MQW = 'MQW';

    case MRD = 'MRD';

    case MRM = 'MRM';

    case MRW = 'MRW';

    case MSK = 'MSK';

    case MTS = 'MTS';

    case MTZ = 'MTZ';

    case MVA = 'MVA';

    case MWH = 'MWH';

    case N1 = 'N1';

    case N10 = 'N10';

    case N11 = 'N11';

    case N12 = 'N12';

    case N13 = 'N13';

    case N14 = 'N14';

    case N15 = 'N15';

    case N16 = 'N16';

    case N17 = 'N17';

    case N18 = 'N18';

    case N19 = 'N19';

    case N20 = 'N20';

    case N21 = 'N21';

    case N22 = 'N22';

    case N23 = 'N23';

    case N24 = 'N24';

    case N25 = 'N25';

    case N26 = 'N26';

    case N27 = 'N27';

    case N28 = 'N28';

    case N29 = 'N29';

    case N3 = 'N3';

    case N30 = 'N30';

    case N31 = 'N31';

    case N32 = 'N32';

    case N33 = 'N33';

    case N34 = 'N34';

    case N35 = 'N35';

    case N36 = 'N36';

    case N37 = 'N37';

    case N38 = 'N38';

    case N39 = 'N39';

    case N40 = 'N40';

    case N41 = 'N41';

    case N42 = 'N42';

    case N43 = 'N43';

    case N44 = 'N44';

    case N45 = 'N45';

    case N46 = 'N46';

    case N47 = 'N47';

    case N48 = 'N48';

    case N49 = 'N49';

    case N50 = 'N50';

    case N51 = 'N51';

    case N52 = 'N52';

    case N53 = 'N53';

    case N54 = 'N54';

    case N55 = 'N55';

    case N56 = 'N56';

    case N57 = 'N57';

    case N58 = 'N58';

    case N59 = 'N59';

    case N60 = 'N60';

    case N61 = 'N61';

    case N62 = 'N62';

    case N63 = 'N63';

    case N64 = 'N64';

    case N65 = 'N65';

    case N66 = 'N66';

    case N67 = 'N67';

    case N68 = 'N68';

    case N69 = 'N69';

    case N70 = 'N70';

    case N71 = 'N71';

    case N72 = 'N72';

    case N73 = 'N73';

    case N74 = 'N74';

    case N75 = 'N75';

    case N76 = 'N76';

    case N77 = 'N77';

    case N78 = 'N78';

    case N79 = 'N79';

    case N80 = 'N80';

    case N81 = 'N81';

    case N82 = 'N82';

    case N83 = 'N83';

    case N84 = 'N84';

    case N85 = 'N85';

    case N86 = 'N86';

    case N87 = 'N87';

    case N88 = 'N88';

    case N89 = 'N89';

    case N90 = 'N90';

    case N91 = 'N91';

    case N92 = 'N92';

    case N93 = 'N93';

    case N94 = 'N94';

    case N95 = 'N95';

    case N96 = 'N96';

    case N97 = 'N97';

    case N98 = 'N98';

    case N99 = 'N99';

    case NA = 'NA';

    case NCL = 'NCL';

    case NEW = 'NEW';

    case NF = 'NF';

    case NIL = 'NIL';

    case NIU = 'NIU';

    case NL = 'NL';

    case NM3 = 'NM3';

    case NMI = 'NMI';

    case NMP = 'NMP';

    case NPT = 'NPT';

    case NT = 'NT';

    case NTU = 'NTU';

    case NU = 'NU';

    case NX = 'NX';

    case OA = 'OA';

    case ODE = 'ODE';

    case ODG = 'ODG';

    case ODK = 'ODK';

    case ODM = 'ODM';

    case OHM = 'OHM';

    case ON = 'ON';

    case OPM = 'OPM';

    case OT = 'OT';

    case OZA = 'OZA';

    case OZI = 'OZI';

    case P1 = 'P1';

    case P10 = 'P10';

    case P11 = 'P11';

    case P12 = 'P12';

    case P13 = 'P13';

    case P14 = 'P14';

    case P15 = 'P15';

    case P16 = 'P16';

    case P17 = 'P17';

    case P18 = 'P18';

    case P19 = 'P19';

    case P2 = 'P2';

    case P20 = 'P20';

    case P21 = 'P21';

    case P22 = 'P22';

    case P23 = 'P23';

    case P24 = 'P24';

    case P25 = 'P25';

    case P26 = 'P26';

    case P27 = 'P27';

    case P28 = 'P28';

    case P29 = 'P29';

    case P30 = 'P30';

    case P31 = 'P31';

    case P32 = 'P32';

    case P33 = 'P33';

    case P34 = 'P34';

    case P35 = 'P35';

    case P36 = 'P36';

    case P37 = 'P37';

    case P38 = 'P38';

    case P39 = 'P39';

    case P40 = 'P40';

    case P41 = 'P41';

    case P42 = 'P42';

    case P43 = 'P43';

    case P44 = 'P44';

    case P45 = 'P45';

    case P46 = 'P46';

    case P47 = 'P47';

    case P48 = 'P48';

    case P49 = 'P49';

    case P5 = 'P5';

    case P50 = 'P50';

    case P51 = 'P51';

    case P52 = 'P52';

    case P53 = 'P53';

    case P54 = 'P54';

    case P55 = 'P55';

    case P56 = 'P56';

    case P57 = 'P57';

    case P58 = 'P58';

    case P59 = 'P59';

    case P60 = 'P60';

    case P61 = 'P61';

    case P62 = 'P62';

    case P63 = 'P63';

    case P64 = 'P64';

    case P65 = 'P65';

    case P66 = 'P66';

    case P67 = 'P67';

    case P68 = 'P68';

    case P69 = 'P69';

    case P70 = 'P70';

    case P71 = 'P71';

    case P72 = 'P72';

    case P73 = 'P73';

    case P74 = 'P74';

    case P75 = 'P75';

    case P76 = 'P76';

    case P77 = 'P77';

    case P78 = 'P78';

    case P79 = 'P79';

    case P80 = 'P80';

    case P81 = 'P81';

    case P82 = 'P82';

    case P83 = 'P83';

    case P84 = 'P84';

    case P85 = 'P85';

    case P86 = 'P86';

    case P87 = 'P87';

    case P88 = 'P88';

    case P89 = 'P89';

    case P90 = 'P90';

    case P91 = 'P91';

    case P92 = 'P92';

    case P93 = 'P93';

    case P94 = 'P94';

    case P95 = 'P95';

    case P96 = 'P96';

    case P97 = 'P97';

    case P98 = 'P98';

    case P99 = 'P99';

    case PAL = 'PAL';

    case PD = 'PD';

    case PFL = 'PFL';

    case PGL = 'PGL';

    case PI = 'PI';

    case PLA = 'PLA';

    case PO = 'PO';

    case PQ = 'PQ';

    case PR = 'PR';

    case PS = 'PS';

    case PTD = 'PTD';

    case PTI = 'PTI';

    case PTL = 'PTL';

    case PTN = 'PTN';

    case Q10 = 'Q10';

    case Q11 = 'Q11';

    case Q12 = 'Q12';

    case Q13 = 'Q13';

    case Q14 = 'Q14';

    case Q15 = 'Q15';

    case Q16 = 'Q16';

    case Q17 = 'Q17';

    case Q18 = 'Q18';

    case Q19 = 'Q19';

    case Q20 = 'Q20';

    case Q21 = 'Q21';

    case Q22 = 'Q22';

    case Q23 = 'Q23';

    case Q24 = 'Q24';

    case Q25 = 'Q25';

    case Q26 = 'Q26';

    case Q27 = 'Q27';

    case Q28 = 'Q28';

    case Q29 = 'Q29';

    case Q3 = 'Q3';

    case Q30 = 'Q30';

    case Q31 = 'Q31';

    case Q32 = 'Q32';

    case Q33 = 'Q33';

    case Q34 = 'Q34';

    case Q35 = 'Q35';

    case Q36 = 'Q36';

    case Q37 = 'Q37';

    case Q38 = 'Q38';

    case Q39 = 'Q39';

    case Q40 = 'Q40';

    case Q41 = 'Q41';

    case Q42 = 'Q42';

    case QA = 'QA';

    case QAN = 'QAN';

    case QB = 'QB';

    case QR = 'QR';

    case QTD = 'QTD';

    case QTI = 'QTI';

    case QTL = 'QTL';

    case QTR = 'QTR';

    case R1 = 'R1';

    case R9 = 'R9';

    case RH = 'RH';

    case RM = 'RM';

    case ROM = 'ROM';

    case RP = 'RP';

    case RPM = 'RPM';

    case RPS = 'RPS';

    case RT = 'RT';

    case S3 = 'S3';

    case S4 = 'S4';

    case SAN = 'SAN';

    case SCO = 'SCO';

    case SCR = 'SCR';

    case SET = 'SET';

    case SG = 'SG';

    case SIE = 'SIE';

    case SM3 = 'SM3';

    case SQ = 'SQ';

    case SQR = 'SQR';

    case SR = 'SR';

    case STC = 'STC';

    case STI = 'STI';

    case STK = 'STK';

    case STL = 'STL';

    case STN = 'STN';

    case STW = 'STW';

    case SW = 'SW';

    case SX = 'SX';

    case SYR = 'SYR';

    case T0 = 'T0';

    case T3 = 'T3';

    case TAH = 'TAH';

    case TAN = 'TAN';

    case TI = 'TI';

    case TIC = 'TIC';

    case TIP = 'TIP';

    case TKM = 'TKM';

    case TMS = 'TMS';

    case TP = 'TP';

    case TPI = 'TPI';

    case TPR = 'TPR';

    case TQD = 'TQD';

    case TRL = 'TRL';

    case TST = 'TST';

    case TTS = 'TTS';

    case U1 = 'U1';

    case U2 = 'U2';

    case UB = 'UB';

    case UC = 'UC';

    case VA = 'VA';

    case VP = 'VP';

    case W2 = 'W2';

    case WA = 'WA';

    case WB = 'WB';

    case WCD = 'WCD';

    case WE = 'WE';

    case WEB = 'WEB';

    case WEE = 'WEE';

    case WG = 'WG';

    case WHR = 'WHR';

    case WM = 'WM';

    case WSD = 'WSD';

    case X1 = 'X1';

    case Z11 = 'Z11';

    case Z9 = 'Z9';

    case ZP = 'ZP';

    case X1_A = 'X1A';

    case X1_B = 'X1B';

    case X1_D = 'X1D';

    case X1_F = 'X1F';

    case X1_G = 'X1G';

    case X1_W = 'X1W';

    case X2_C = 'X2C';

    case X3_A = 'X3A';

    case X3_H = 'X3H';

    case X43 = 'X43';

    case X44 = 'X44';

    case X4_A = 'X4A';

    case X4_B = 'X4B';

    case X4_C = 'X4C';

    case X4_D = 'X4D';

    case X4_F = 'X4F';

    case X4_G = 'X4G';

    case X4_H = 'X4H';

    case X5_H = 'X5H';

    case X5_L = 'X5L';

    case X5_M = 'X5M';

    case X6_H = 'X6H';

    case X6_P = 'X6P';

    case X7_A = 'X7A';

    case X7_B = 'X7B';

    case X8_A = 'X8A';

    case X8_B = 'X8B';

    case X8_C = 'X8C';

    case XIZ = 'XIZ';

    case XKG = 'XKG';

    case XKI = 'XKI';

    case XNS = 'XNS';

    case XNT = 'XNT';

    case XNU = 'XNU';

    case XNV = 'XNV';

    case XO1 = 'XO1';

    case XO2 = 'XO2';

    case XO3 = 'XO3';

    case XO4 = 'XO4';

    case XO5 = 'XO5';

    case XO6 = 'XO6';

    case XO7 = 'XO7';

    case XO8 = 'XO8';

    case XO9 = 'XO9';

    case XT1 = 'XT1';
}
