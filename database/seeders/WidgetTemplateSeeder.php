<?php

namespace Database\Seeders;

use App\Models\Language;

use App\Models\WidgetTemplate;
use App\Models\WidgetType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WidgetTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $type = WidgetType::where('slug', 'bank-statement-checker')->first();
        $langEs = Language::where('code', 'es')->first();

        $validationRules = [
            'threshold' => 100,
            'banks' => [
                ['name' => 'Afirme', 'keys' => ['banca afirme', 'afirme.com', 'www.afirme.com']],
                ['name' => 'Albo', 'keys' => ['albo', 'albo.mx']],
                ['name' => 'Banco Azteca', 'keys' => ['banco azteca', 'azteca', 'bancoazteca.com.mx']],
                ['name' => 'Banamex', 'keys' => ['banamex', 'citibanamex', 'tarjeta banamex']],
                ['name' => 'BanBajio', 'keys' => ['banbajio', 'del bajio']],
                ['name' => 'BanCoppel', 'keys' => ['bancoppel', 'bancoppel.com']],
                ['name' => 'Banorte', 'keys' => ['banorte', 'ixe', 'banorte.com']],
                ['name' => 'BBVA', 'keys' => ['bbva mexico', 'bbva.mx']],
                ['name' => 'HSBC', 'keys' => ['hsbc']],
                ['name' => 'Mercado Pago', 'keys' => ['mercado', 'mercadopago', 'mercadolibre']],
                ['name' => 'Mifel', 'keys' => ['mifel', 'mifel.com.mx']],
                ['name' => 'Invex Banco', 'keys' => ['invex', 'invex banco', 'invex.com', 'www.invextarjetas.com.mx', 'invextarjetas.com.mx', 'now.bank', 'www.now.bank']],
                ['name' => 'NU', 'keys' => ['nu mexico', 'nu financiera', 'nu.com.mx']],
                ['name' => 'Openbank', 'keys' => ['openbank', 'openbank mexico', 'openbank.mx', 'www.openbank.mx']],
                ['name' => 'Santander', 'keys' => ['santander', 'banco santander']],
                ['name' => 'Scotiabank', 'keys' => ['scotiabank', 'scotiabank inverlat', 'scotiabank.com.mx', 'www.scotiabank.com.mx']],
                ['name' => 'Spin', 'keys' => ['spin by oxxo', 'compropago', 'spinbyoxxo.com.mx', 'www.spinbyoxxo.com.mx']],
                ['name' => 'Uala', 'keys' => ['uala', 'uala.mx', 'www.uala.mx']]
            ],
            'rules' => [
                ['id' => 'doc_type', 'label' => 'Тип документа', 'pattern' => 'estado de cuenta|extracto|resumen de cuenta', 'flags' => 'gi', 'weight' => 30],
                ['id' => 'balance_info', 'label' => 'Баланс', 'pattern' => 'saldo al corte|saldo anterior|saldo final|saldo promedio', 'flags' => 'gi', 'weight' => 35],
                ['id' => 'account_number', 'label' => 'Номер счета', 'pattern' => '(?:cuenta|contrato|cliente)[\\s\\S]{0,30}\\b\\d{5,20}\\b', 'flags' => 'gi', 'weight' => 25],
                ['id' => 'transaction_headers', 'label' => 'Сетка транзакций', 'pattern' => 'fecha[\\s\\S]{0,50}(?:descripcion|concepto|referencia)[\\s\\S]{0,50}(?:cargo|transaccion|abono|saldo|movimiento)', 'flags' => 'gi', 'weight' => 25],
                ['id' => 'clabe_info', 'label' => 'CLABE', 'pattern' => 'clabe|(?:\\b\\d{18}\\b)', 'flags' => 'gi', 'weight' => 30],
                ['id' => 'rfc_info', 'label' => 'RFC', 'pattern' => 'rfc[\\s\\S]{0,12}[a-z]{3,4}\\s?\\d{6}\\s?[a-z0-9]{3}', 'flags' => 'gi', 'weight' => 20],
                ['id' => 'currency', 'label' => 'Валюта', 'pattern' => '\\$', 'flags' => 'g', 'weight' => 5],
            ]
        ];

        $periodRules = [
            'monthMap' => [
                'enero' => 0,
                'febrero' => 1,
                'marzo' => 2,
                'abril' => 3,
                'mayo' => 4,
                'junio' => 5,
                'julio' => 6,
                'agosto' => 7,
                'septiembre' => 8,
                'octubre' => 9,
                'noviembre' => 10,
                'diciembre' => 11,
                'ene' => 0,
                'feb' => 1,
                'mar' => 2,
                'abr' => 3,
                'may' => 4,
                'jun' => 5,
                'jul' => 6,
                'ago' => 7,
                'sep' => 8,
                'oct' => 9,
                'nov' => 10,
                'dic' => 11,
                'ene.' => 0,
                'feb.' => 1,
                'mar.' => 2,
                'abr.' => 3,
                'may.' => 4,
                'jun.' => 5,
                'jul.' => 6,
                'ago.' => 7,
                'sep.' => 8,
                'oct.' => 9,
                'nov.' => 10,
                'dic.' => 11,
            ],
            'techKeywordsBefore' => ['impres', 'oferta', 'de calculo', 'operacion', 'de corte', 'oficial', 'fecha y hora', 'impresion', 'hora de expedicion', 'generacion', 'certificacion', 'a partir del', 'en vigor', 'calculada al', 'disposicion oficial'],
            'techKeywordsAfter' => ['n½mina', 'semanal', 'quincenal', 'emitido en cuida', 'por cobranz'],
            'safeKeywordsBefore' => ['periodo'],
            'patterns' => [
                ['pattern' => '\\b(?<d1>\\d{1,2})\\s+(?:de\\s+)?(?<m1>[a-z]{3,10}\\.?)\\s+(?:al|-)\\s+(?<d2>\\d{1,2})\\s+(?:de\\s+)?(?<m2>[a-z]{3,10}\\.?)\\s+(?:del\\s+|de\\s+)?(?<year>\\d{4})\\b', 'flags' => 'gi'],
                ['pattern' => '\\b(?:del\\s+)?(?<d1>\\d{1,2})\\s+al\\s+(?<d2>\\d{1,2})\\s+(?:de\\s+)?(?<month>[a-z]{3,10}\\.?)\\s+(?:del\\s+|de\\s+)?(?<year>\\d{4})\\b', 'flags' => 'gi'],
                ['pattern' => '\\b(?<day>\\d{1,2})[./-](?<month>[a-z]{3,10}\\.?|\\d{1,2})[./-](?<year>\\d{2}|\\d{4})\\b', 'flags' => 'gi'],
                ['pattern' => '\\b(?<day>\\d{1,2})\\s+(?:de\\s+)?(?<month>[a-z]{3,10}\\.?)\\s+(?:de\\s+)?(?<year>\\d{4}|\\d{2})\\b', 'flags' => 'gi']
            ]
        ];

        $template = WidgetTemplate::updateOrCreate(
            ['slug' => 'mexico-bank-statement'],
            [
                'widget_type_id' => $type->id,
                'name' => 'Mexico: Bank Statement',
                'country_code' => 'mx',
                'ocr_lang' => 'spa', // Для OCR библиотеки

                'validation_rules' => $validationRules,
                'period_rules' => $periodRules,

                'default_language_id' => $langEs->id,
                'is_active' => true,
            ]
        );



        // Добавляем дефолтные тексты админа для этого шаблона
        $template->translations()->updateOrCreate(
            ['language_id' => $langEs->id],
            [
                'content' => [
                    'ui' => [
                        'title' => 'Verifica tu Estado de Cuenta',
                        'description' => 'Sube tu archivo PDF para validar el periodo.',
                        'button_text' => 'Subir PDF',
                        'loading_text' => 'Procesando archivo...'
                    ],
                    'messages' => [
                        'success' => 'Archivo validado correctamente.',
                        'error_invalid_pdf' => 'El archivo no es un PDF válido.',
                        'error_wrong_bank' => 'Banco no soportado.',
                        'error_wrong_period' => 'El periodo no coincide con lo solicitado.'
                    ]
                ]
            ]
        );
    }
}