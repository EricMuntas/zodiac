<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Horoscope;
use App\Http\Requests\StoreHoroscopeRequest;
use App\Http\Requests\UpdateHoroscopeRequest;
use App\Models\Lang;
use Stichoza\GoogleTranslate\GoogleTranslate;
class HoroscopeController extends Controller
{
    public function importHoroscope()
    {
            //$langs= Lang::all();
            $horoscopes = ['aquarius', 'pisces', 'aries', 'taurus',
                        'gemini', 'cancer', 'leo', 'virgo', 'libra', 
                        'scorpio', 'sagittarius', 'capricorn'];
            $times = ['today'];
            
            foreach($times as $time){
                foreach($horoscopes as $horoscope){
                    $text = file_get_contents("https://www.astrology-zodiac-signs.com/api/call.php?time=$time&sign=$horoscope");
                    Horoscope::create([
                        'date' => date('d/m/Y'),
                        'lang' => 'en',
                        'sign' => $horoscope,
                        'time' => 'today',
                        'phrase' => $text,
                    ]);
                }

            }
                    
      

        return response()->json(['message' => 'Horoscope imported successfully']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHoroscopeRequest $request)
    {
        //
    }
    private function translateText($text, $language)
    {
        $translator = new GoogleTranslate();
        $translator->setSource('en');
        $translator->setTarget($language); 
        return $translator->translate($text);
    }
    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $sign = $request->input('sign');
        $time = $request->input('time');

        $url = "https://www.astrology-zodiac-signs.com/api/call.php?time=$time&sign=$sign";
        $text = file_get_contents($url);

        $language = $request->input('language');
        $translatedText = $this->translateText($text, $language);

        return $translatedText;
    }
    
    public function showApi(Request $request)
    {
        $sign = $request->input('sign');
        $time = $request->input('time');
    
        $url = "https://www.astrology-zodiac-signs.com/api/call.php?time=$time&sign=$sign";
        $text = file_get_contents($url);
    
        $language = $request->input('language');
        $translatedText = $this->translateText($text, $language);
       
        $translatedText = utf8_encode($translatedText);

        return response()->json([
            'horoscope' => $translatedText
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Horoscope $horoscope)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHoroscopeRequest $request, Horoscope $horoscope)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Horoscope $horoscope)
    {
        //
    }
}
