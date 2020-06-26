<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use CV\Face\LBPHFaceRecognizer, CV\CascadeClassifier, CV\Scalar, CV\Point;
use function CV\{imread,imwrite, cvtColor, equalizeHist, rectangleByRect, rectangle, putText};
use const CV\{COLOR_BGR2GRAY};

class Controller extends BaseController
{
    public static $faceClassifier;
    public function __construct()
    {
        $files = scandir("Images/".$request->id."/root");

        $this->faceClassifier = new CascadeClassifier();
        $this->faceClassifier->load('runphpopencv/models/lbpcascades/lbpcascade_frontalface.xml');
        $faceRecognizer = LBPHFaceRecognizer::create();
        $labels = ['unknown', 'me', 'angelina'];

        $files = scandir("Images/1/root");
        $faceImages = $faceLabels = [];
        foreach ($files as $key => $file){
            if ($key>1){
                $src = imread("Images/".$request->id."/root/".$file);
                $gray = cvtColor($src, COLOR_BGR2GRAY);
                $this->faceClassifier->detectMultiScale($gray, $faces);
                equalizeHist($gray, $gray);
                $facemax = null;
                $Acreage = 0;
                foreach ($faces as $k => $face) {
                    if($face->height*$face->width > $Acreage){
                        $Acreage = $face->height*$face->width;
                        $facemax = $face;
                    }
                }
                $faceImages[] = $gray->getImageROI($facemax);
                $faceLabels[] = 1;
                imwrite("recognize_face_by_lbph_angelina$k$key.jpg", $gray->getImageROI($face));
            }
        }
        $faceRecognizer->train($faceImages, $faceLabels);
        $files = scandir("Images/31/root");
        $faceImages = $faceLabels = [];
        foreach ($files as $key => $file){
            if ($key>1){
                $src = imread("Images/31/root/".$file);
                $gray = cvtColor($src, COLOR_BGR2GRAY);
                $this->faceClassifier->detectMultiScale($gray, $faces);
                equalizeHist($gray, $gray);
                $facemax = null;
                $Acreage = 0;
                foreach ($faces as $k => $face) {
                    if($face->height*$face->width > $Acreage){
                        $Acreage = $face->height*$face->width;
                        $facemax = $face;
                    }
                }
                $faceImages[] = $gray->getImageROI($facemax);
                $faceLabels[] = 2;
                imwrite("recognize_face_by_lbph_angelina$key.jpg", $gray->getImageROI($facemax));
            }
        }
        $faceRecognizer->update($faceImages, $faceLabels);

    }

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
