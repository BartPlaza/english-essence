<?php

namespace App;

use Illuminate\Http\UploadedFile;
use Storage;


class CsvImporter
{
    const PATH = '../storage/app/csv/';
    private $file;

    public function __construct(UploadedFile $file)
    {
        $this->file = $file;
    }

    public function save(): void
    {
        $this->file->move(self::PATH, $this->file->getFilename());
    }

    public function saveToDatabase()
    {
        $result = $this->convertToArray();
        $counter = 0;
        $qty = count($result);
        if($result) {
            foreach ($result as $item) {
                $exists = Word::where('pl', $item['pl'])->where('en', $item['en'])->first();
                if (!$exists) {
                    Word::create(['pl' => $item['pl'], 'en' => $item['en']]);
                    $counter++;
                }
            }
        }
        return ['found' => $qty, 'saved' => $counter, 'duplicated' => $qty-$counter];
    }

    private function convertToArray()
    {
        if (!$this->fileExists()) {
            return false;
        }
        $data = [];
        $headers = ['pl', 'en'];
        if ($handle = fopen($this->fullPath(), 'r')) {
            while ($row = fgetcsv($handle, 1000, ',')) {
                if(count($row) === 2 && $row[0] !== '' && $row[1] !== '')
                array_push($data, array_combine($headers, $row));
            }
        }
        return $data;
    }

    public function remove(): void
    {
        Storage::disk('local')->delete('csv/'.$this->file->getFilename());
    }

    private function fileExists(): bool
    {
        if ((file_exists($this->fullPath()) && (is_readable($this->fullPath())))) {
            return true;
        }
        return false;
    }

    private function fullPath()
    {
        return self::PATH . $this->file->getFilename();
    }
}