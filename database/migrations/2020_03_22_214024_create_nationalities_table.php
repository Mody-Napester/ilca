<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNationalitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nationalities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->default('');
            $table->string('name_en')->default('');
            $table->string('name_ar')->default('');
            $table->string('nationality_en')->default('');
            $table->string('nationality_ar')->default('');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nationalities');
    }
}

/*


INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('AF', 'Afghanistan','أفغانستان','Afghan','أفغانستاني');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('AL', 'Albania','ألبانيا','Albanian','ألباني');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('AX', 'Aland Islands','جزر آلاند','Aland Islander','آلاندي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('DZ', 'Algeria','الجزائر','Algerian','جزائري');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('AS', 'American Samoa','ساموا-الأمريكي','American Samoan','أمريكي سامواني');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('AD', 'Andorra','أندورا','Andorran','أندوري');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('AO', 'Angola','أنغولا','Angolan','أنقولي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('AI', 'Anguilla','أنغويلا','Anguillan','أنغويلي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('AQ', 'Antarctica','أنتاركتيكا','Antarctican','أنتاركتيكي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('AG', 'Antigua and Barbuda','أنتيغوا وبربودا','Antiguan','بربودي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('AR', 'Argentina','الأرجنتين','Argentinian','أرجنتيني');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('AM', 'Armenia','أرمينيا','Armenian','أرميني');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('AW', 'Aruba','أروبه','Aruban','أوروبهيني');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('AU', 'Australia','أستراليا','Australian','أسترالي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('AT', 'Austria','النمسا','Austrian','نمساوي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('AZ', 'Azerbaijan','أذربيجان','Azerbaijani','أذربيجاني');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('BS', 'Bahamas','الباهاماس','Bahamian','باهاميسي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('BH', 'Bahrain','البحرين','Bahraini','بحريني');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('BD', 'Bangladesh','بنغلاديش','Bangladeshi','بنغلاديشي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('BB', 'Barbados','بربادوس','Barbadian','بربادوسي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('BY', 'Belarus','روسيا البيضاء','Belarusian','روسي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('BE', 'Belgium','بلجيكا','Belgian','بلجيكي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('BZ', 'Belize','بيليز','Belizean','بيليزي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('BJ', 'Benin','بنين','Beninese','بنيني');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('BL', 'Saint Barthelemy','سان بارتيلمي','Saint Barthelmian','سان بارتيلمي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('BM', 'Bermuda','جزر برمودا','Bermudan','برمودي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('BT', 'Bhutan','بوتان','Bhutanese','بوتاني');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('BO', 'Bolivia','بوليفيا','Bolivian','بوليفي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('BA', 'Bosnia and Herzegovina','البوسنة و الهرسك','Bosnian / Herzegovinian','بوسني/هرسكي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('BW', 'Botswana','بوتسوانا','Botswanan','بوتسواني');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('BV', 'Bouvet Island','جزيرة بوفيه','Bouvetian','بوفيهي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('BR', 'Brazil','البرازيل','Brazilian','برازيلي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('IO', 'British Indian Ocean Territory','إقليم المحيط الهندي البريطاني','British Indian Ocean Territory','إقليم المحيط الهندي البريطاني');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('BN', 'Brunei Darussalam','بروني','Bruneian','بروني');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('BG', 'Bulgaria','بلغاريا','Bulgarian','بلغاري');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('BF', 'Burkina Faso','بوركينا فاسو','Burkinabe','بوركيني');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('BI', 'Burundi','بوروندي','Burundian','بورونيدي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('KH', 'Cambodia','كمبوديا','Cambodian','كمبودي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('CM', 'Cameroon','كاميرون','Cameroonian','كاميروني');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('CA', 'Canada','كندا','Canadian','كندي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('CV', 'Cape Verde','الرأس الأخضر','Cape Verdean','الرأس الأخضر');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('KY', 'Cayman Islands','جزر كايمان','Caymanian','كايماني');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('CF', 'Central African Republic','جمهورية أفريقيا الوسطى','Central African','أفريقي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('TD', 'Chad','تشاد','Chadian','تشادي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('CL', 'Chile','شيلي','Chilean','شيلي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('CN', 'China','الصين','Chinese','صيني');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('CX', 'Christmas Island','جزيرة عيد الميلاد','Christmas Islander','جزيرة عيد الميلاد');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('CC', 'Cocos (Keeling) Islands','جزر كوكوس','Cocos Islander','جزر كوكوس');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('CO', 'Colombia','كولومبيا','Colombian','كولومبي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('KM', 'Comoros','جزر القمر','Comorian','جزر القمر');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('CG', 'Congo','الكونغو','Congolese','كونغي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('CK', 'Cook Islands','جزر كوك','Cook Islander','جزر كوك');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('CR', 'Costa Rica','كوستاريكا','Costa Rican','كوستاريكي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('HR', 'Croatia','كرواتيا','Croatian','كوراتي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('CU', 'Cuba','كوبا','Cuban','كوبي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('CY', 'Cyprus','قبرص','Cypriot','قبرصي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('CW', 'Curaçao','كوراساو','Curacian','كوراساوي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('CZ', 'Czech Republic','الجمهورية التشيكية','Czech','تشيكي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('DK', 'Denmark','الدانمارك','Danish','دنماركي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('DJ', 'Djibouti','جيبوتي','Djiboutian','جيبوتي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('DM', 'Dominica','دومينيكا','Dominican','دومينيكي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('DO', 'Dominican Republic','الجمهورية الدومينيكية','Dominican','دومينيكي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('EC', 'Ecuador','إكوادور','Ecuadorian','إكوادوري');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('EG', 'Egypt','مصر','Egyptian','مصري');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('SV', 'El Salvador','إلسلفادور','Salvadoran','سلفادوري');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('GQ', 'Equatorial Guinea','غينيا الاستوائي','Equatorial Guinean','غيني');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('ER', 'Eritrea','إريتريا','Eritrean','إريتيري');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('EE', 'Estonia','استونيا','Estonian','استوني');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('ET', 'Ethiopia','أثيوبيا','Ethiopian','أثيوبي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('FK', 'Falkland Islands (Malvinas)','جزر فوكلاند','Falkland Islander','فوكلاندي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('FO', 'Faroe Islands','جزر فارو','Faroese','جزر فارو');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('FJ', 'Fiji','فيجي','Fijian','فيجي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('FI', 'Finland','فنلندا','Finnish','فنلندي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('FR', 'France','فرنسا','French','فرنسي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('GF', 'French Guiana','غويانا الفرنسية','French Guianese','غويانا الفرنسية');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('PF', 'French Polynesia','بولينيزيا الفرنسية','French Polynesian','بولينيزيي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('TF', 'French Southern and Antarctic Lands','أراض فرنسية جنوبية وأنتارتيكية','French','أراض فرنسية جنوبية وأنتارتيكية');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('GA', 'Gabon','الغابون','Gabonese','غابوني');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('GM', 'Gambia','غامبيا','Gambian','غامبي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('GE', 'Georgia','جيورجيا','Georgian','جيورجي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('DE', 'Germany','ألمانيا','German','ألماني');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('GH', 'Ghana','غانا','Ghanaian','غاني');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('GI', 'Gibraltar','جبل طارق','Gibraltar','جبل طارق');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('GG', 'Guernsey','غيرنزي','Guernsian','غيرنزي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('GR', 'Greece','اليونان','Greek','يوناني');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('GL', 'Greenland','جرينلاند','Greenlandic','جرينلاندي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('GD', 'Grenada','غرينادا','Grenadian','غرينادي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('GP', 'Guadeloupe','جزر جوادلوب','Guadeloupe','جزر جوادلوب');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('GU', 'Guam','جوام','Guamanian','جوامي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('GT', 'Guatemala','غواتيمال','Guatemalan','غواتيمالي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('GN', 'Guinea','غينيا','Guinean','غيني');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('GW', 'Guinea-Bissau','غينيا-بيساو','Guinea-Bissauan','غيني');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('GY', 'Guyana','غيانا','Guyanese','غياني');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('HT', 'Haiti','هايتي','Haitian','هايتي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('HM', 'Heard and Mc Donald Islands','جزيرة هيرد وجزر ماكدونالد','Heard and Mc Donald Islanders','جزيرة هيرد وجزر ماكدونالد');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('HN', 'Honduras','هندوراس','Honduran','هندوراسي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('HK', 'Hong Kong','هونغ كونغ','Hongkongese','هونغ كونغي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('HU', 'Hungary','المجر','Hungarian','مجري');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('IS', 'Iceland','آيسلندا','Icelandic','آيسلندي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('IN', 'India','الهند','Indian','هندي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('IM', 'Isle of Man','جزيرة مان','Manx','ماني');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('ID', 'Indonesia','أندونيسيا','Indonesian','أندونيسيي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('IR', 'Iran','إيران','Iranian','إيراني');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('IQ', 'Iraq','العراق','Iraqi','عراقي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('IE', 'Ireland','إيرلندا','Irish','إيرلندي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('IL', 'Israel','إسرائيل','Israeli','إسرائيلي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('IT', 'Italy','إيطاليا','Italian','إيطالي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('CI', 'Ivory Coast','ساحل العاج','Ivory Coastian','ساحل العاج');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('JE', 'Jersey','جيرزي','Jersian','جيرزي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('JM', 'Jamaica','جمايكا','Jamaican','جمايكي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('JP', 'Japan','اليابان','Japanese','ياباني');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('JO', 'Jordan','الأردن','Jordanian','أردني');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('KZ', 'Kazakhstan','كازاخستان','Kazakh','كازاخستاني');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('KE', 'Kenya','كينيا','Kenyan','كيني');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('KI', 'Kiribati','كيريباتي','I-Kiribati','كيريباتي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('KP', 'Korea(North Korea)','كوريا الشمالية','North Korean','كوري');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('KR', 'Korea(South Korea)','كوريا الجنوبية','South Korean','كوري');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('XK', 'Kosovo','كوسوفو','Kosovar','كوسيفي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('KW', 'Kuwait','الكويت','Kuwaiti','كويتي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('KG', 'Kyrgyzstan','قيرغيزستان','Kyrgyzstani','قيرغيزستاني');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('LA', 'Lao PDR','لاوس','Laotian','لاوسي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('LV', 'Latvia','لاتفيا','Latvian','لاتيفي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('LB', 'Lebanon','لبنان','Lebanese','لبناني');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('LS', 'Lesotho','ليسوتو','Basotho','ليوسيتي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('LR', 'Liberia','ليبيريا','Liberian','ليبيري');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('LY', 'Libya','ليبيا','Libyan','ليبي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('LI', 'Liechtenstein','ليختنشتين','Liechtenstein','ليختنشتيني');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('LT', 'Lithuania','لتوانيا','Lithuanian','لتوانيي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('LU', 'Luxembourg','لوكسمبورغ','Luxembourger','لوكسمبورغي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('LK', 'Sri Lanka','سريلانكا','Sri Lankian','سريلانكي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('MO', 'Macau','ماكاو','Macanese','ماكاوي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('MK', 'Macedonia','مقدونيا','Macedonian','مقدوني');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('MG', 'Madagascar','مدغشقر','Malagasy','مدغشقري');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('MW', 'Malawi','مالاوي','Malawian','مالاوي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('MY', 'Malaysia','ماليزيا','Malaysian','ماليزي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('MV', 'Maldives','المالديف','Maldivian','مالديفي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('ML', 'Mali','مالي','Malian','مالي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('MT', 'Malta','مالطا','Maltese','مالطي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('MH', 'Marshall Islands','جزر مارشال','Marshallese','مارشالي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('MQ', 'Martinique','مارتينيك','Martiniquais','مارتينيكي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('MR', 'Mauritania','موريتانيا','Mauritanian','موريتانيي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('MU', 'Mauritius','موريشيوس','Mauritian','موريشيوسي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('YT', 'Mayotte','مايوت','Mahoran','مايوتي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('MX', 'Mexico','المكسيك','Mexican','مكسيكي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('FM', 'Micronesia','مايكرونيزيا','Micronesian','مايكرونيزيي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('MD', 'Moldova','مولدافيا','Moldovan','مولديفي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('MC', 'Monaco','موناكو','Monacan','مونيكي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('MN', 'Mongolia','منغوليا','Mongolian','منغولي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('ME', 'Montenegro','الجبل الأسود','Montenegrin','الجبل الأسود');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('MS', 'Montserrat','مونتسيرات','Montserratian','مونتسيراتي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('MA', 'Morocco','المغرب','Moroccan','مغربي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('MZ', 'Mozambique','موزمبيق','Mozambican','موزمبيقي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('MM', 'Myanmar','ميانمار','Myanmarian','ميانماري');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('NA', 'Namibia','ناميبيا','Namibian','ناميبي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('NR', 'Nauru','نورو','Nauruan','نوري');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('NP', 'Nepal','نيبال','Nepalese','نيبالي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('NL', 'Netherlands','هولندا','Dutch','هولندي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('AN', 'Netherlands Antilles','جزر الأنتيل الهولندي','Dutch Antilier','هولندي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('NC', 'New Caledonia','كاليدونيا الجديدة','New Caledonian','كاليدوني');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('NZ', 'New Zealand','نيوزيلندا','New Zealander','نيوزيلندي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('NI', 'Nicaragua','نيكاراجوا','Nicaraguan','نيكاراجوي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('NE', 'Niger','النيجر','Nigerien','نيجيري');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('NG', 'Nigeria','نيجيريا','Nigerian','نيجيري');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('NU', 'Niue','ني','Niuean','ني');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('NF', 'Norfolk Island','جزيرة نورفولك','Norfolk Islander','نورفوليكي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('MP', 'Northern Mariana Islands','جزر ماريانا الشمالية','Northern Marianan','ماريني');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('NO', 'Norway','النرويج','Norwegian','نرويجي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('OM', 'Oman','عمان','Omani','عماني');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('PK', 'Pakistan','باكستان','Pakistani','باكستاني');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('PW', 'Palau','بالاو','Palauan','بالاوي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('PS', 'Palestine','فلسطين','Palestinian','فلسطيني');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('PA', 'Panama','بنما','Panamanian','بنمي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('PG', 'Papua New Guinea','بابوا غينيا الجديدة','Papua New Guinean','بابوي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('PY', 'Paraguay','باراغواي','Paraguayan','بارغاوي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('PE', 'Peru','بيرو','Peruvian','بيري');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('PH', 'Philippines','الفليبين','Filipino','فلبيني');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('PN', 'Pitcairn','بيتكيرن','Pitcairn Islander','بيتكيرني');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('PL', 'Poland','بولونيا','Polish','بوليني');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('PT', 'Portugal','البرتغال','Portuguese','برتغالي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('PR', 'Puerto Rico','بورتو ريكو','Puerto Rican','بورتي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('QA', 'Qatar','قطر','Qatari','قطري');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('RE', 'Reunion Island','ريونيون','Reunionese','ريونيوني');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('RO', 'Romania','رومانيا','Romanian','روماني');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('RU', 'Russian','روسيا','Russian','روسي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('RW', 'Rwanda','رواندا','Rwandan','رواندا');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('KN', 'Saint Kitts and Nevis','سانت كيتس ونيفس,','Kittitian/Nevisian','سانت كيتس ونيفس');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('MF', 'Saint Martin (French part)','ساينت مارتن فرنسي','St. Martian(French)','ساينت مارتني فرنسي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('SX', 'Sint Maarten (Dutch part)','ساينت مارتن هولندي','St. Martian(Dutch)','ساينت مارتني هولندي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('LC', 'Saint Pierre and Miquelon','سان بيير وميكلون','St. Pierre and Miquelon','سان بيير وميكلوني');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('VC', 'Saint Vincent and the Grenadines','سانت فنسنت وجزر غرينادين','Saint Vincent and the Grenadines','سانت فنسنت وجزر غرينادين');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('WS', 'Samoa','ساموا','Samoan','ساموي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('SM', 'San Marino','سان مارينو','Sammarinese','ماريني');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('ST', 'Sao Tome and Principe','ساو تومي وبرينسيبي','Sao Tomean','ساو تومي وبرينسيبي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('SA', 'Saudi Arabia','المملكة العربية السعودية','Saudi Arabian','سعودي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('SN', 'Senegal','السنغال','Senegalese','سنغالي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('RS', 'Serbia','صربيا','Serbian','صربي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('SC', 'Seychelles','سيشيل','Seychellois','سيشيلي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('SL', 'Sierra Leone','سيراليون','Sierra Leonean','سيراليوني');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('SG', 'Singapore','سنغافورة','Singaporean','سنغافوري');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('SK', 'Slovakia','سلوفاكيا','Slovak','سولفاكي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('SI', 'Slovenia','سلوفينيا','Slovenian','سولفيني');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('SB', 'Solomon Islands','جزر سليمان','Solomon Island','جزر سليمان');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('SO', 'Somalia','الصومال','Somali','صومالي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('ZA', 'South Africa','جنوب أفريقيا','South African','أفريقي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('GS', 'South Georgia and the South Sandwich','المنطقة القطبية الجنوبية','South Georgia and the South Sandwich','لمنطقة القطبية الجنوبية');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('SS', 'South Sudan','السودان الجنوبي','South Sudanese','سوادني جنوبي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('ES', 'Spain','إسبانيا','Spanish','إسباني');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('SH', 'Saint Helena','سانت هيلانة','St. Helenian','هيلاني');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('SD', 'Sudan','السودان','Sudanese','سوداني');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('SR', 'Suriname','سورينام','Surinamese','سورينامي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('SJ', 'Svalbard and Jan Mayen','سفالبارد ويان ماين','Svalbardian/Jan Mayenian','سفالبارد ويان ماين');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('SZ', 'Swaziland','سوازيلند','Swazi','سوازيلندي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('SE', 'Sweden','السويد','Swedish','سويدي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('CH', 'Switzerland','سويسرا','Swiss','سويسري');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('SY', 'Syria','سوريا','Syrian','سوري');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('TW', 'Taiwan','تايوان','Taiwanese','تايواني');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('TJ', 'Tajikistan','طاجيكستان','Tajikistani','طاجيكستاني');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('TZ', 'Tanzania','تنزانيا','Tanzanian','تنزانيي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('TH', 'Thailand','تايلندا','Thai','تايلندي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('TL', 'Timor-Leste','تيمور الشرقية','Timor-Lestian','تيموري');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('TG', 'Togo','توغو','Togolese','توغي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('TK', 'Tokelau','توكيلاو','Tokelaian','توكيلاوي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('TO', 'Tonga','تونغا','Tongan','تونغي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('TT', 'Trinidad and Tobago','ترينيداد وتوباغو','Trinidadian/Tobagonian','ترينيداد وتوباغو');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('TN', 'Tunisia','تونس','Tunisian','تونسي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('TR', 'Turkey','تركيا','Turkish','تركي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('TM', 'Turkmenistan','تركمانستان','Turkmen','تركمانستاني');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('TC', 'Turks and Caicos Islands','جزر توركس وكايكوس','Turks and Caicos Islands','جزر توركس وكايكوس');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('TV', 'Tuvalu','توفالو','Tuvaluan','توفالي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('UG', 'Uganda','أوغندا','Ugandan','أوغندي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('UA', 'Ukraine','أوكرانيا','Ukrainian','أوكراني');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('AE', 'United Arab Emirates','الإمارات العربية المتحدة','Emirati','إماراتي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('GB', 'United Kingdom','المملكة المتحدة','British','بريطاني');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('US', 'United States','الولايات المتحدة','American','أمريكي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('UM', 'US Minor Outlying Islands','قائمة الولايات والمناطق الأمريكية','US Minor Outlying Islander','أمريكي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('UY', 'Uruguay','أورغواي','Uruguayan','أورغواي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('UZ', 'Uzbekistan','أوزباكستان','Uzbek','أوزباكستاني');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('VU', 'Vanuatu','فانواتو','Vanuatuan','فانواتي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('VE', 'Venezuela','فنزويلا','Venezuelan','فنزويلي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('VN', 'Vietnam','فيتنام','Vietnamese','فيتنامي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('VI', 'Virgin Islands (U.S.)','الجزر العذراء الأمريكي','American Virgin Islander','أمريكي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('VA', 'Vatican City','فنزويلا','Vatican','فاتيكاني');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('WF', 'Wallis and Futuna Islands','والس وفوتونا','Wallisian/Futunan','فوتوني');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('EH', 'Western Sahara','الصحراء الغربية','Sahrawian','صحراوي');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('YE', 'Yemen','اليمن','Yemeni','يمني');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('ZM', 'Zambia','زامبيا','Zambian','زامبياني');
INSERT INTO `nationalities` (`code`,`name_en`,`name_ar`,`nationality_en`,`nationality_ar`) VALUES ('ZW', 'Zimbabwe','زمبابوي','Zimbabwean','زمبابوي');


*/