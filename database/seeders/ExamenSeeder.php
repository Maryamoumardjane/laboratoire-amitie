<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Examen;

class ExamenSeeder extends Seeder
{
    public function run()
    {
        $data = [

        // ================= HÉMATOLOGIE =================
        ['nom'=>'D-Dimères',           'categorie'=>'Hématologie','prix'=>20000,'delai'=>'30 minutes'],
        ['nom'=>'Frottis sanguin + NFS','categorie'=>'Hématologie','prix'=>15000,'delai'=>'2 jours'],
        ['nom'=>'GsRh',                'categorie'=>'Hématologie','prix'=>5000, 'delai'=>'1 heure'],
        ['nom'=>'NFS',                 'categorie'=>'Hématologie','prix'=>5000, 'delai'=>'30 minutes'],
        ['nom'=>'TCA',                 'categorie'=>'Hématologie','prix'=>5000, 'delai'=>'1 heure'],
        ['nom'=>'TP',                  'categorie'=>'Hématologie','prix'=>5000, 'delai'=>'1 heure'],
        ['nom'=>'VS',                  'categorie'=>'Hématologie','prix'=>3000, 'delai'=>'2 heures'],

        // ================= BACTÉRIOLOGIE =================
        ['nom'=>'Chlamydia IFD',        'categorie'=>'Bactériologie','prix'=>15000,'delai'=>'1 heure'],
        ['nom'=>'Chlamydia ELISA',       'categorie'=>'Bactériologie','prix'=>30000,'delai'=>'2 jours'],
        ['nom'=>'Coproculture',          'categorie'=>'Bactériologie','prix'=>15000,'delai'=>'3 jours'],
        ['nom'=>'Culot urinaire',        'categorie'=>'Bactériologie','prix'=>3000, 'delai'=>'1 heure'],
        ['nom'=>'ECBU + ATB',            'categorie'=>'Bactériologie','prix'=>10000,'delai'=>'3 jours'],
        ['nom'=>'Hémoculture',           'categorie'=>'Bactériologie','prix'=>15000,'delai'=>'10 jours'],
        ['nom'=>'PCV + ATB',             'categorie'=>'Bactériologie','prix'=>10000,'delai'=>'3 jours'],
        ['nom'=>'Prélèvement de gorge',  'categorie'=>'Bactériologie','prix'=>15000,'delai'=>'3 jours'],
        ['nom'=>'PU + ATB',              'categorie'=>'Bactériologie','prix'=>10000,'delai'=>'3 jours'],
        ['nom'=>'PUS/liquide',           'categorie'=>'Bactériologie','prix'=>15000,'delai'=>'3 jours'],
        ['nom'=>'Mycoplasmes',           'categorie'=>'Bactériologie','prix'=>15000,'delai'=>'3 jours'],
        ['nom'=>'Culture bout de sonde', 'categorie'=>'Bactériologie','prix'=>15000,'delai'=>'3 jours'],
        ['nom'=>'Spermoculture',         'categorie'=>'Bactériologie','prix'=>15000,'delai'=>'3 jours'],
        ['nom'=>'Prélèvement nasal',     'categorie'=>'Bactériologie','prix'=>15000,'delai'=>'3 jours'],
        ['nom'=>'Spermogramme',          'categorie'=>'Bactériologie','prix'=>15000,'delai'=>'2 jours'],

        // ================= BIOCHIMIE =================
        ['nom'=>'Acide urique',      'categorie'=>'Biochimie','prix'=>3000, 'delai'=>'1 heure'],
        ['nom'=>'Albumine',          'categorie'=>'Biochimie','prix'=>3000, 'delai'=>'2 heures'],
        ['nom'=>'Amylase',           'categorie'=>'Biochimie','prix'=>5000, 'delai'=>'2 heures'],
        ['nom'=>'Bilirubine directe','categorie'=>'Biochimie','prix'=>5000, 'delai'=>'2 heures'],
        ['nom'=>'Bilirubine totale', 'categorie'=>'Biochimie','prix'=>5000, 'delai'=>'2 heures'],
        ['nom'=>'Calcium',           'categorie'=>'Biochimie','prix'=>3000, 'delai'=>'1 heure'],
        ['nom'=>'Profil lipidique',  'categorie'=>'Biochimie','prix'=>15000,'delai'=>'1 heure'],
        ['nom'=>'Créatinine',        'categorie'=>'Biochimie','prix'=>3000, 'delai'=>'1 heure'],
        ['nom'=>'Urée',              'categorie'=>'Biochimie','prix'=>3000, 'delai'=>'1 heure'],
        ['nom'=>'Electrophorèse Hb', 'categorie'=>'Biochimie','prix'=>10000,'delai'=>'2 jours'],
        ['nom'=>'Fer sérique',       'categorie'=>'Biochimie','prix'=>8000, 'delai'=>'2 jours'],
        ['nom'=>'Gamma GT',          'categorie'=>'Biochimie','prix'=>5000, 'delai'=>'2 heures'],
        ['nom'=>'Glycémie à jeun',   'categorie'=>'Biochimie','prix'=>3000, 'delai'=>'1 heure'],
        ['nom'=>'Glycémie post',     'categorie'=>'Biochimie','prix'=>3000, 'delai'=>'1 heure'],
        ['nom'=>'Ionogramme simple', 'categorie'=>'Biochimie','prix'=>9000, 'delai'=>'1 heure'],
        ['nom'=>'Ionogramme complet','categorie'=>'Biochimie','prix'=>15000,'delai'=>'1 heure'],
        ['nom'=>'Magnésium',         'categorie'=>'Biochimie','prix'=>3000, 'delai'=>'1 heure'],
        ['nom'=>'HbA1C',             'categorie'=>'Biochimie','prix'=>15000,'delai'=>'1 heure'],
        ['nom'=>'PAL',               'categorie'=>'Biochimie','prix'=>8000, 'delai'=>'1 heure'],
        ['nom'=>'Phosphate',         'categorie'=>'Biochimie','prix'=>8000, 'delai'=>'1 heure'],
        ['nom'=>'ASAT + ALAT',       'categorie'=>'Biochimie','prix'=>6000, 'delai'=>'1 heure'],
        ['nom'=>'Troponine',         'categorie'=>'Biochimie','prix'=>15000,'delai'=>'30 minutes'],
        ['nom'=>'Cortisol',          'categorie'=>'Biochimie','prix'=>20000,'delai'=>'1 heure'],

        // ================= IMMUNO =================
        ['nom'=>'HIV',          'categorie'=>'Immuno','prix'=>5000, 'delai'=>'1 heure'],
        ['nom'=>'CRP',          'categorie'=>'Immuno','prix'=>5000, 'delai'=>'30 minutes'],
        ['nom'=>'Beta HCG',     'categorie'=>'Immuno','prix'=>15000,'delai'=>'1 heure'],
        ['nom'=>'TSH',          'categorie'=>'Immuno','prix'=>15000,'delai'=>'1 heure'],
        ['nom'=>'Testostérone', 'categorie'=>'Immuno','prix'=>20000,'delai'=>'1 heure'],
        ['nom'=>'Widal',        'categorie'=>'Immuno','prix'=>5000, 'delai'=>'1 heure'],

        // ================= PARASITOLOGIE =================
        ['nom'=>'Coprologie KOAP','categorie'=>'Parasitologie','prix'=>2000,'delai'=>'1 heure'],
        ['nom'=>'Schistosomes',   'categorie'=>'Parasitologie','prix'=>3000,'delai'=>'1 heure'],
        ['nom'=>'RMF',            'categorie'=>'Parasitologie','prix'=>5000,'delai'=>'1 heure'],
        ['nom'=>'GE/HP',          'categorie'=>'Parasitologie','prix'=>2000,'delai'=>'1 heure'],

        // ================= ÉCHOGRAPHIE =================
        // — Gynéco-obstétrical & Abdominal —
        ['nom'=>'Échographie Obstétricale',            'categorie'=>'Échographie','prix'=>15000,'delai'=>'Immédiat'],
        ['nom'=>'Échographie Pelvienne',               'categorie'=>'Échographie','prix'=>12000,'delai'=>'Immédiat'],
        ['nom'=>'Échographie Pelvienne (endovaginale)','categorie'=>'Échographie','prix'=>15000,'delai'=>'Immédiat'],
        ['nom'=>'Échographie Abdominale',              'categorie'=>'Échographie','prix'=>12000,'delai'=>'Immédiat'],
        ['nom'=>'Échographie Abdomino-pelvienne',      'categorie'=>'Échographie','prix'=>15000,'delai'=>'Immédiat'],
        ['nom'=>'Échographie Prostatique',             'categorie'=>'Échographie','prix'=>12000,'delai'=>'Immédiat'],
        ['nom'=>'Échographie Prostatique (endorectale)','categorie'=>'Échographie','prix'=>15000,'delai'=>'Immédiat'],
        // — Autres —
        ['nom'=>'Échographie Testiculaire',            'categorie'=>'Échographie','prix'=>12000,'delai'=>'Immédiat'],
        ['nom'=>'Échographie Rénale, vésicale et Prostatique','categorie'=>'Échographie','prix'=>15000,'delai'=>'Immédiat'],
        ['nom'=>'Échographie Mammaire',                'categorie'=>'Échographie','prix'=>12000,'delai'=>'Immédiat'],
        ['nom'=>'Échographie Parties molles',          'categorie'=>'Échographie','prix'=>10000,'delai'=>'Immédiat'],
        ['nom'=>'Échographie (autre — à préciser)',    'categorie'=>'Échographie','prix'=>12000,'delai'=>'Immédiat'],
        // — Cardiologie —
        ['nom'=>'ECG (Électrocardiogramme)',           'categorie'=>'Échographie','prix'=>10000,'delai'=>'Immédiat'],
        ['nom'=>'Echo Cœur (Échocardiographie)',       'categorie'=>'Échographie','prix'=>25000,'delai'=>'Immédiat'],

        ];

        Examen::insert($data);
    }
}