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
        // We get all the lessons from the database
        $lessons = DB::table('lessons')->get();

        // We get only the images of the lessons
        foreach($lessons as $lesson){
                preg_match_all('/<img.*?src=[\'"](.*?)[\'"].*?>/i', $lesson->body, $matches);
                if(!empty($matches[1])) {
                    foreach($matches[1] as $match)
                    $elements[] = $match;
                }
            }

        // We format the image names to match the names of those images in the folder
        foreach($elements as $element){
            $imagesWanted[] = 'storage/uploads/lessons/'.pathinfo($element)["basename"];
        }
        
        // We get all lesson images that are uploaded on the server
        $allImagesInFolder = Storage::files('/storage/uploads/lessons/');

        // We remove the .gitignore file from the selection
        $allImagesInFolder = array_diff($allImagesInFolder, ["storage/uploads/lessons/.gitignore"]);

        // The difference shows which images are still in the server but unused from lessons
        $imagesDelete = array_diff($allImagesInFolder, $imagesWanted);

        // We delete all unused images from the server
        Storage::disk('local')->delete($imagesDelete);

        $this->info('All unused lesson images are deleted successfully');
    }
}
