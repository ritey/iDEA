<?php

namespace Idea\Traits;

trait Shrink {
	/**
	 * Remove spaces and carriage returns from a string
     * Ideal for condensing HTML template files
	 * @param  $string
	 * @return string
	 */
    public function shrink($html)
    {
        return preg_replace('/(\>)\s*(\<)/m','><',$html);
    }
}