<?php

namespace Schrattenholz\CallToActions;

use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\TabSet;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use Silverstripe\ORM\DataObject;
use SilverStripe\CMS\Model\SiteTree;
class CallToAction extends DataObject{
	private static $table_name="calltoaction";
	private static $db=[
		'Content'=>'HTMLText',
		'SortID'=>'Int'
	];
	private static $belongs_many_many=[
		'Pages'=>SiteTree::class
	];
	public function getCMSFields(){
		$fields=parent::getCMSFields();
		$fields->addFieldToTab('Root.Main',new HTMLEditorField('Content','Inhalt'));
		$fields->removeFieldFromTab('Root.Main','SortID');
		return $fields;
	}
	public function onBeforeWrite(){
		parent::onBeforeWrite();
	}
	// Get content for internal search and searchengines
	public function getContents(){
		return $this->Content;
	}
	public function renderIt(){
		return $this->renderWith($this->ClassName);	
	}
	private static $singular_name ="CallToAction";
	private static $plural_name = "CallToActions"; 
}