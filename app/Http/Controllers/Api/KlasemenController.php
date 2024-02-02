<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\DB;

class KlasemenController extends Controller
{
    public function index()
    {
        $klasemen = DB::select('
        WITH ClubStats AS (
            SELECT
                k.id AS klub_id,
                k.nama AS nama_klub,
                COALESCE(COUNT(hp.id), 0) AS total_main,
                SUM(CASE 
                    WHEN hp.klub_tuan_rumah_id = k.id AND hp.skor_tuan_rumah > hp.skor_tamu THEN 1
                    WHEN hp.klub_tamu_id = k.id AND hp.skor_tuan_rumah < hp.skor_tamu THEN 1
                    ELSE 0 
                END) AS total_menang,
                SUM(CASE 
                    WHEN hp.klub_tuan_rumah_id = k.id AND hp.skor_tuan_rumah = hp.skor_tamu THEN 1
                    WHEN hp.klub_tamu_id = k.id AND hp.skor_tuan_rumah = hp.skor_tamu THEN 1
                    ELSE 0 
                END) AS total_seri,
                SUM(CASE 
                    WHEN hp.klub_tuan_rumah_id = k.id AND hp.skor_tuan_rumah < hp.skor_tamu THEN 1
                    WHEN hp.klub_tamu_id = k.id AND hp.skor_tuan_rumah > hp.skor_tamu THEN 1
                    ELSE 0 
                END) AS total_kalah,
                SUM(CASE 
                    WHEN hp.klub_tuan_rumah_id = k.id THEN hp.skor_tuan_rumah
                    WHEN hp.klub_tamu_id = k.id THEN hp.skor_tamu
                    ELSE 0 
                END) AS total_goal,
                SUM(CASE 
                    WHEN hp.klub_tuan_rumah_id = k.id THEN hp.skor_tamu
                    WHEN hp.klub_tamu_id = k.id THEN hp.skor_tuan_rumah
                    ELSE 0 
                END) AS total_kebobolan,
                SUM(
                    CASE
                        WHEN hp.skor_tuan_rumah > hp.skor_tamu THEN 3
                        WHEN hp.skor_tuan_rumah = hp.skor_tamu THEN 1
                        ELSE 0
                    END
                ) AS total_poin
            FROM
                klubs k
            LEFT JOIN 
                hasil_pertandingans hp ON (k.id = hp.klub_tuan_rumah_id OR k.id = hp.klub_tamu_id)
                                   AND k.id IN (hp.klub_tuan_rumah_id, hp.klub_tamu_id)
            GROUP BY
                k.id, k.nama
        )
        SELECT
            nama_klub,
            total_main,
            total_menang,
            total_seri,
            total_kalah,
            total_goal,
            total_kebobolan,
            total_poin
        FROM
            ClubStats
        ORDER BY
            total_poin DESC,
            (total_goal - total_kebobolan) DESC,
            total_goal DESC;
        ');

        //return collection of posts as a resource
        return new PostResource(true, 'Data Klasemen', $klasemen);
    }
}
