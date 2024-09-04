<?php

namespace Nuxtifyts\NuxtifyPages\Data;

enum Block: string
{
    case HEADING = 'heading';
    case PARAGRAPH = 'paragraph';
    case IMAGE = 'image';
    case SLOT = 'slot';
}
