<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ImageCleanup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'image:cleanup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Removes unused images from uploads/lessons/ folder';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $lessons = DB::table('lessons')->get();

        foreach($lessons as $lesson){
                preg_match_all('/<img.*?src=[\'"](.*?)[\'"].*?>/i', $lesson->body, $matches);
                if(!empty($matches[1])) {
                    foreach($matches[1] as $match)
                    $elements[] = $match;
                }
            }
        
        foreach($elements as $element){
            $imagesWanted[] = 'storage/uploads/lessons/'.pathinfo($element)["basename"];
        }
        
        $allImagesInFolder = Storage::files('/storage/uploads/lessons/');
        $allImagesInFolder = array_diff($allImagesInFolder, ["storage/uploads/lessons/.gitignore"]);

        $imagesDelete = array_diff($allImagesInFolder, $imagesWanted);
        Storage::disk('local')->delete($imagesDelete);

        $this->info('All unused lesson images are deleted successfully');
    }
}
