
const validationRulesConfig = {
    threshold: 100,
    banks: [
        { name: 'Afirme', keys: ['banca afirme', 'afirme.com', 'www.afirme.com'] },
        { name: 'Albo', keys: ['albo', 'albo.mx'] },
        { name: 'Banco Azteca', keys: ['banco azteca', 'azteca', 'bancoazteca.com.mx'] },
        { name: 'Banamex', keys: ['banamex', 'citibanamex', 'tarjeta banamex'] },
        { name: 'BanBajio', keys: ['banbajio', 'del bajio'] },
        { name: 'BanCoppel', keys: ['bancoppel', 'bancoppel.com'] },
        { name: 'Banorte', keys: ['banorte', 'ixe', 'banorte.com'] },
        { name: 'BBVA', keys: ['bbva mexico', 'bbva.mx'] },
        { name: 'HSBC', keys: ['hsbc'] },
        { name: 'Mercado Pago', keys: ['mercado', 'mercadopago', 'mercadolibre'] },
        { name: 'Mifel', keys: ['mifel', 'mifel.com.mx'] },
        { name: 'Invex Banco', keys: ['invex', 'invex banco', 'invex.com', 'www.invextarjetas.com.mx', 'invextarjetas.com.mx', 'now.bank', 'www.now.bank'] },
        { name: 'NU', keys: ['nu mexico', 'nu financiera', 'nu.com.mx'] },
        { name: 'Openbank', keys: ['openbank', 'openbank mexico', 'openbank.mx', 'www.openbank.mx'] },
        { name: 'Santander', keys: ['santander', 'banco santander'] },
        { name: 'Scotiabank', keys: ['scotiabank', 'scotiabank inverlat', 'scotiabank.com.mx', 'www.scotiabank.com.mx'] },
        { name: 'Spin', keys: ['spin by oxxo', 'compropago', 'spinbyoxxo.com.mx', 'www.spinbyoxxo.com.mx'] },
        { name: 'Uala', keys: ['uala', 'uala.mx', 'www.uala.mx'] }
    ],
    rules: [
        {
            id: 'doc_type',
            label: 'Тип документа',
            pattern: /estado de cuenta|extracto|resumen de cuenta/gi,
            weight: 30
        },
        {
            id: 'balance_info',
            label: 'Баланс',
            pattern: /saldo al corte|saldo anterior|saldo final|saldo promedio/gi,
            weight: 35
        },
        {
            id: 'account_number',
            label: 'Номер счета',
            pattern: /(?:cuenta|contrato|cliente)[\s\S]{0,30}\b\d{5,20}\b/gi,
            weight: 25
        },
        {
            id: 'transaction_headers',
            label: 'Сетка транзакций',
            pattern: /fecha[\s\S]{0,50}(?:descripcion|concepto|referencia)[\s\S]{0,50}(?:cargo|transaccion|abono|saldo|movimiento)/gi,
            weight: 25
        },
        {
            id: 'clabe_info',
            label: 'CLABE',
            pattern: /clabe|(?:\b\d{18}\b)/gi,
            weight: 30
        },
        {
            id: 'rfc_info',
            label: 'RFC',
            pattern: /rfc[\s\S]{0,12}[a-z]{3,4}\s?\d{6}\s?[a-z0-9]{3}/gi,
            weight: 20
        },
        {
            id: 'currency',
            label: 'Валюта',
            pattern: /\$/g,
            weight: 5
        }
    ]
};

const periodRulesConfig = {
    monthMap: {
        'enero': 0, 'febrero': 1, 'marzo': 2, 'abril': 3, 'mayo': 4, 'junio': 5,
        'julio': 6, 'agosto': 7, 'septiembre': 8, 'octubre': 9, 'noviembre': 10, 'diciembre': 11,
        'ene': 0, 'feb': 1, 'mar': 2, 'abr': 3, 'may': 4, 'jun': 5,
        'jul': 6, 'ago': 7, 'sep': 8, 'oct': 9, 'nov': 10, 'dic': 11,
        'ene.': 0, 'feb.': 1, 'mar.': 2, 'abr.': 3, 'may.': 4, 'jun.': 5,
        'jul.': 6, 'ago.': 7, 'sep.': 8, 'oct.': 9, 'nov.': 10, 'dic.': 11,
    },
    techKeywordsBefore: [
        'impres', 'oferta', 'de calculo', 'operacion', 'de corte', 'oficial', 'fecha y hora',
        'impresion', 'hora de expedicion', 'generacion', 'certificacion',
        'a partir del', 'en vigor', 'calculada al', 'disposicion oficial'
    ],
    techKeywordsAfter: [
        'n½mina', 'semanal', 'quincenal',
        'emitido en cuida', 'por cobranz'
    ],
    safeKeywordsBefore: [
        'periodo'
    ],
    patterns: [
        /\b(?<d1>\d{1,2})\s+(?:de\s+)?(?<m1>[a-z]{3,10}\.?)\s+(?:al|-)\s+(?<d2>\d{1,2})\s+(?:de\s+)?(?<m2>[a-z]{3,10}\.?)\s+(?:del\s+|de\s+)?(?<year>\d{4})\b/gi,

        /\b(?:del\s+)?(?<d1>\d{1,2})\s+al\s+(?<d2>\d{1,2})\s+(?:de\s+)?(?<month>[a-z]{3,10}\.?)\s+(?:del\s+|de\s+)?(?<year>\d{4})\b/gi,

        /\b(?<day>\d{1,2})[./-](?<month>[a-z]{3,10}\.?|\d{1,2})[./-](?<year>\d{2}|\d{4})\b/gi,

        /\b(?<day>\d{1,2})\s+(?:de\s+)?(?<month>[a-z]{3,10}\.?)\s+(?:de\s+)?(?<year>\d{4}|\d{2})\b/gi
    ]

};





console.log('validation_rules_config:');
console.log(validationRulesConfig);
console.log('');
console.log('period_rules_config:');
console.log(periodRulesConfig);
console.log('');



// ? get rulles
async function testWidgetConfig() {
    try {
        const response = await fetch('/test-config');
        const data = await response.json();

        // Функция для превращения строковых паттернов в реальные RegExp
        // const rehydrate = (obj) => {
        //     if (Array.isArray(obj)) return obj.map(rehydrate);
        //     if (obj !== null && typeof obj === 'object') {
        //         if (obj.pattern && obj.flags) {
        //             return new RegExp(obj.pattern, obj.flags);
        //         }
        //         const newObj = {};
        //         for (let key in obj) {
        //             newObj[key] = rehydrate(obj[key]);
        //         }
        //         return newObj;
        //     }
        //     return obj;
        // };

        // const finalValidationRules = rehydrate(data.validation_rules);
        // const finalPeriodRules = rehydrate(data.period_rules);

        // console.log('--- RECONSTRUCTED VALIDATION RULES ---', finalValidationRules);
        // console.log('--- RECONSTRUCTED PERIOD RULES ---', finalPeriodRules);

        function regFromString(obj) {
            // const m = s.match(/^\/(.+)\/([gimsuy]*)$/);
            if (obj.pattern && obj.flags) {
                return new RegExp(obj.pattern, obj.flags);
            }

            return null;
        }


        const validation_rules = data.validation_rules;

        if (validation_rules) {
            const rules = [];
            const dataRuless = validation_rules.rules;
            dataRuless.forEach(rule => {

                const patternObj = {

                    'pattern': rule.pattern,
                    'flags': rule.flags,
                };
                const patternString = regFromString(patternObj);
                if (patternString) {
                    delete rule.flags;

                    rule.pattern = patternString;

                    rules.push(rule);
                }
            });

            validation_rules.rules = rules;

            console.log('validation_rules:');
            console.log(validation_rules);
            console.log('');
        }


        const period_rules = data.period_rules;

        if (period_rules) {
            const patterns = [];
            const dataPatterns = period_rules.patterns;
            dataPatterns.forEach(pattern => {
                const patternString = regFromString(pattern);
                if (patternString) {
                    patterns.push(patternString);
                }
            });
            period_rules.patterns = patterns;

            console.log('period_rules:');
            console.log(period_rules);
            console.log('');
        }

        // Теперь ты можешь сравнить эти объекты с твоими оригиналами в JS
    } catch (e) {
        console.error('Test failed', e);
    }
}
testWidgetConfig();