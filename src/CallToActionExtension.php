<?php 	

// Integriert die Moeglichkeit am rechten Rand einer Seite Labels mit Klickfuncktoin anzuzeigen

namespace Schrattenholz\CallToActions;

use SilverStripe\Core\Extension; 
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\NumericField;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Forms\LiteralField;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\HiddenField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\Forms\TabSet;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use SilverStripe\Forms\GridField\GridFieldConfig;
use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;
use SilverStripe\Forms\GridField\GridFieldButtonRow;
use SilverStripe\Forms\GridField\GridFieldToolbarHeader;
use SilverStripe\Forms\GridField\GridFieldDeleteAction;
use SilverStripe\Forms\GridField\GridFieldDataColumns;
use SilverStripe\Forms\GridField\GridFieldEditButton;
use SilverStripe\Forms\GridField\GridFieldDetailForm;
use SilverStripe\Forms\GridField\GridFieldSortableHeader;
use SilverStripe\Forms\GridField\GridFieldPaginator;
use SilverStripe\Forms\GridField\GridFieldFilterHeader;

use Symbiote\GridFieldExtensions\GridFieldEditableColumns;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;
use Symbiote\GridFieldExtensions\GridFieldAddNewMultiClass;

class CallToActionsExtension extends Extension{
	private static $db=[
		'HasCallToActions'=>'Boolean'
	];
	private static $many_many=[
		'CallToActions'=>CallToAction::class
	];
	public function updateCMSFields(FieldList $fields) {
		$fields->addFieldToTab('Root.Main',new CheckboxField('HasCallToActions','Inhalte am Rand anzeigen (Speichern um Reiter anzuzeigen)'),'Content');
		$gridFieldConfig=GridFieldConfig::create()
			->addComponent(new GridFieldButtonRow('before'))
			->addComponent(new GridFieldDataColumns)
			->addComponent(new GridFieldDeleteAction())
			->addComponent(new GridFieldEditButton())
			->addComponent(new GridFieldDetailForm())
			->addComponent(new GridFieldSortableHeader())
			->addComponent(new GridFieldFilterHeader())
			->addComponent(new GridFieldPaginator())
			->addComponent(new GridFieldOrderableRows('SortID'))
		;
		$gridFieldConfig->addComponent(new GridFieldAddNewMultiClass());
		$gridFieldConfig->removeComponentsByType('GridFieldAddNewButton');
		if($this->getOwner()->HasCallToActions){
			$fields->addFieldToTab('Root.Inhalte am Browserand', GridField::create(
				'CallToActions',
				'CallToActions',
				$this->owner->CallToActions(),
				$gridFieldConfig
			));
		}
	}
		 public function onAfterInit(){
		$vars = [
			"Link"=>$this->getOwner()->Link(),
			"ID"=>$this->owner->ID
		];
		Requirements::javascriptTemplate("schrattenholz/calltoactions:javascript/calltoactions.js",$vars);
	}
}