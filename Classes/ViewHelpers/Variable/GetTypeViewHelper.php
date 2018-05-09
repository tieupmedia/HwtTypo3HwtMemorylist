<?php

namespace Hwt\HwtMemorylist\ViewHelpers\Variable;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2016 Heiko Westermann <hwt3@gmx.de>
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/
/**
 * Get type ViewHelper which renders the class name of the given object in value argument
 * value is an instance of provided class name.
 *
 * @author Heiko Westermann <hwt3@gmx.de>
 * @package hwt_memorylist
 */
class GetTypeViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

    use \TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;

    public function initializeArguments() {
        $this->registerArgument('value', 'mixed', 'The object to evaluate');
    }



    /**
     * Returns the type of the input variable
     *
     * @param array $arguments
     * @param \Closure $renderChildrenClosure
     * @param \TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface $renderingContext
     * @return string
     * @throws InvalidVariableException
     */
    public static function renderStatic(array $arguments, \Closure $renderChildrenClosure, \TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface $renderingContext)
    {
        $value = $arguments['value'];
        if ( $value === null ) {
            $value = $renderChildrenClosure();
        }

        return get_class($value);
    }
}
