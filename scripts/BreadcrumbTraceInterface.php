<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 25.08.2015
 * Time: 17:46
 */

namespace cubiclab\project\scripts;

interface BreadcrumbTraceInterface {

    /**
     * Returns the BreadCrumb Trace for the current model
     *
     * @return string[] the breadcrumb trace from top hierarchy model down to the current model.
     */
//    public function bct_getBreadcrumbTrace();

    public function bct_getParent();

    public function bct_getBreadcrumb();
}