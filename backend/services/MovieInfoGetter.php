<?php

namespace WTW\services;

class MovieInfoGetter
{
    public function getArrayInfo(InterfaceMovieRepository $movieRepository): array
    {
        $info = $movieRepository->getMovie();
        return array($info);
    }
}