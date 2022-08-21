<?php

namespace App\Services;

class MovieInfoGetter
{
    public function getArrayInfo(InterfaceMovieRepository $movieRepository): array
    {
        $info = $movieRepository->getMovie();
        return array($info);
    }
}
