
# HwtTypo3HwtMemorylist

## About:
This TYPO3 extension provides a flexible memory list for TYPO3 >= 7.6


## Features:

**Conceptual + Backend**

- Add universal record types to a memory list, configurable via typoscript

**Plugin - Frontend**

- Plugin to show memory list in frontend
- Plugin actions to add, remove and show list in FE via ajax
- Demo buttons to call plugin actions adaptable in custom extensions / templates

**Integration**

- Installable via Composer


## Installation:
The currently released versions are available in the TYPO3 Extension Repository (TER) or via composer. So you can 
 - download and install the extension with the extension manager inside the TYPO3 Backend

or

- do `composer require tieupmedia/hwt_memorylist` from your console

Further you can manually get the versioned source code from github and manually upload the extension. If you do so, name the extension folder "hwt_memorylist" (don't keep the git library name)!


## Manual:

### Create memory listing
The extension comes with a memory list plugin, which shows up the current list. You can insert it as common in TYPO3 with a plugin content element or manually create it via centralized TypoScript.

### Create control elments to add / remove items
The memory list is designed to work with ajax controls, to add or remove items from the list. So just create the related control elements and initialize them with the ajax javascript.

**1) Create control elements**

If you insert the memory list plugin, some demo controls are shown  by default. You can easily remove them via the TS constant `plugin.tx_hwtmemorylist.settings.enableDemoTemplates` in the Constants Editor or in your TS records/files.

The controls need three data attributes:
- **data-hwtmemorylist-model** with a value of one of the record types defined inside the TS setup `plugin.tx_hwtmemorylist.settingsrecordTypes`
- **data-hwtmemorylist-recordid** with a value of the uid of the record to add or remove
- **data-hwtmemorylist-action** with a value 'add' or 'remove' to declare, what action should be done

Example:
```
<a href="#" class="hwtmemorylist-ctrl" data-hwtmemorylist-model="AShortRecordIdentifier" data-hwtmemorylist-recordid="1" data-hwtmemorylist-action="add">
```
See more examples in the '_ListDemoItemControls_' partial.

**2) Initialize Ajax**

To initialize the ajax calling, bind the elements to the _hwtmemorylistCtrlInit()_ function.
```
jQuery('.hwtmemorylist-ctrl').on('click', hwtmemorylistCtrlInit);
```
In the Ajax.js file included in this extension, initializes elements with the css class _'hwtmemorylist-ctrl' by default_.

### How to configure a custom record for the memory list
To register a new record type for the memory list, add it to the _'recordTypes'_ in the TypoScript settings. Choose a custom record identifier and and configure the repository class in the subproperty. 

(The repository _must implement the function 'findByUid'_.)
```
plugin.tx_hwtmemorylist.settings {
    recordTypes {
        AShortRecordIdentifier {
            repository = Vendor\Extension\Domain\Repository\TheModelRepository
        }
    }
}
```

## Versions:
- \>= 0.0.4 for TYPO3 7.6 - 8.7
- \>= 0.0.5 for TYPO3 7.6 - 9.x

## Migrations:
**0.0.5 to 0.0.6**
The TypoScript key `plugin.tx_hwtmemorylist.settings.list.recordtypes` moved to `plugin.tx_hwtmemorylist.settings.recordTypes`.
