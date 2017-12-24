<?php
/**
 * XLS操作类
 * author: Tom
 */
namespace Common\Vendor;

include('PHPExcel/PHPExcel.php');

class PhpExcel
{
    private $xls;

    public function __construct(){
        $this->xls = new \PHPExcel();
    }

    public function hasMacros(){
        return $this->xls->hasMacros();
    }

    public function setHasMacros($hasMacros=false){
        $this->xls->setHasMacros($hasMacros);
    }

    public function setMacrosCode($MacrosCode){
        $this->xls->setMacrosCode($MacrosCode);
    }

    public function getMacrosCode(){
        return $this->xls->getMacrosCode();
    }

    public function setMacrosCertificate($Certificate=NULL){
        $this->xls->setMacrosCertificate($Certificate);
    }

    public function hasMacrosCertificate(){
        return $this->xls->hasMacrosCertificate();
    }

    public function getMacrosCertificate(){
        return $this->xls->getMacrosCertificate();
    }

    public function discardMacros(){
        $this->xls->discardMacros();
    }

    public function setRibbonXMLData($Target=NULL, $XMLData=NULL){
        $this->xls->setRibbonXMLData($Target,$XMLData);
    }

    public function getRibbonXMLData($What='all'){//we need some constants here...
        $this->xls->getRibbonXMLData($What);
    }

    public function setRibbonBinObjects($BinObjectsNames=NULL, $BinObjectsData=NULL){
        $this->xls->setRibbonBinObjects($BinObjectsNames,$BinObjectsData);
    }

    public function getRibbonBinObjects($What='all'){
        return $this->xls->getRibbonBinObjects($What);
    }

    public function hasRibbon(){
        return $this->xls->hasRibbon();
    }

    public function hasRibbonBinObjects(){
        return $this->xls->hasRibbonBinObjects();
    }

    public function sheetCodeNameExists($pSheetCodeName)
    {
        return $this->xls->sheetCodeNameExists($pSheetCodeName);
    }

    public function getSheetByCodeName($pName = '')
    {
        return $this->xls->getSheetByCodeName($pName);
    }

    public function disconnectWorksheets()
    {
        $this->xls->disconnectWorksheets();
    }

    public function getCalculationEngine()
    {

        return $this->xls->getCalculationEngine();
    }

    public function getProperties()
    {
        return $this->xls->getProperties();
    }

    public function setProperties(PHPExcel_DocumentProperties $pValue)
    {
        $this->xls->setProperties($pValue);
    }

    public function getSecurity()
    {
        return $this->xls->getSecurity();
    }

    public function setSecurity(PHPExcel_DocumentSecurity $pValue)
    {
        $this->xls->setSecurity($pValue);
    }

    public function getActiveSheet()
    {
        return $this->xls->getActiveSheet();
    }

    public function createSheet($iSheetIndex = NULL)
    {
        return $this->xls->createSheet($iSheetIndex);
    }

    public function sheetNameExists($pSheetName)
    {
        return $this->xls->sheetNameExists($pSheetName);
    }

    public function addSheet(PHPExcel_Worksheet $pSheet, $iSheetIndex = NULL)
    {
        return $this->xls->addSheet($pSheet,$iSheetIndex);
    }

    public function removeSheetByIndex($pIndex = 0)
    {
        $this->xls->removeSheetByIndex($pIndex);
    }

    public function getSheet($pIndex = 0)
    {
        return $this->xls->getSheet($pIndex);
    }

    public function getAllSheets()
    {
        return $this->xls->getAllSheets();
    }

    public function getSheetByName($pName = '')
    {
        return $this->xls->getSheetByName($pName);
    }

    public function getIndex(PHPExcel_Worksheet $pSheet)
    {
        return $this->xls->getIndex($pSheet);
    }

    public function setIndexByName($sheetName, $newIndex)
    {
        return $this->xls->setIndexByName($sheetName,$newIndex);
    }

    public function getSheetCount()
    {
        return $this->xls->getSheetCount();
    }

    public function getActiveSheetIndex()
    {
        return $this->xls->getActiveSheetIndex();
    }

    public function setActiveSheetIndex($pIndex = 0)
    {
        return $this->xls->setActiveSheetIndex($pIndex);
    }

    public function setActiveSheetIndexByName($pValue = '')
    {
        return $this->xls->setActiveSheetIndexByName($pValue);
    }

    public function getSheetNames()
    {
        return $this->xls->getSheetNames();
    }

    public function addExternalSheet(PHPExcel_Worksheet $pSheet, $iSheetIndex = null) {
        return $this->xls->addExternalSheet($pSheet,$iSheetIndex);
    }

    public function getNamedRanges() {
        return $this->xls->getNamedRanges();
    }

    public function addNamedRange(PHPExcel_NamedRange $namedRange) {
        return $this->xls->addNamedRange($namedRange);
    }

    public function getNamedRange($namedRange, PHPExcel_Worksheet $pSheet = null) {
        return $this->xls->getNamedRange($namedRange,$pSheet);
    }

    public function removeNamedRange($namedRange, PHPExcel_Worksheet $pSheet = null) {
        return $this->xls->removeNamedRange($namedRange,$pSheet);
    }

    public function getWorksheetIterator() {
        return $this->xls->getWorksheetIterator();
    }

    public function copy() {
        return $this->xls->copy();
    }

    public function __clone() {
        foreach($this as $key => $val) {
            if (is_object($val) || (is_array($val))) {
                $this->{$key} = unserialize(serialize($val));
            }
        }
    }

    public function getCellXfCollection()
    {
        return $this->xls->getCellXfCollection();
    }

    public function getCellXfByIndex($pIndex = 0)
    {
        return $this->xls->getCellXfByIndex($pIndex);
    }

    public function getCellXfByHashCode($pValue = '')
    {
        return $this->xls->getCellXfByHashCode($pValue);
    }

    public function cellXfExists($pCellStyle = null)
    {
        return $this->xls->cellXfExists($pCellStyle);
    }

    public function getDefaultStyle()
    {
        return $this->xls->getDefaultStyle();
    }

    public function addCellXf(PHPExcel_Style $style)
    {
        $this->xls->addCellXf($style);
    }

    public function removeCellXfByIndex($pIndex = 0)
    {
        $this->xls->removeCellXfByIndex($pIndex);
    }

    public function getCellXfSupervisor()
    {
        return $this->xls->getCellXfSupervisor();
    }

    public function getCellStyleXfCollection()
    {
        return $this->xls->getCellStyleXfCollection();
    }

    public function getCellStyleXfByIndex($pIndex = 0)
    {
        return $this->xls->getCellStyleXfByIndex($pIndex);
    }

    public function getCellStyleXfByHashCode($pValue = '')
    {
        return $this->xls->getCellStyleXfByHashCode($pValue);
    }

    public function addCellStyleXf(PHPExcel_Style $pStyle)
    {
        $this->xls->addCellStyleXf($pStyle);
    }

    public function removeCellStyleXfByIndex($pIndex = 0)
    {
        $this->xls->removeCellStyleXfByIndex($pIndex);
    }

    public function garbageCollect()
    {
        $this->xls->garbageCollect();
    }

    public function getID() {
        return $this->xls->getID();
    }
}