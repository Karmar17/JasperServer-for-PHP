<?php
/* ==========================================================================

 Copyright (C) 2005 - 2012 Jaspersoft Corporation. All rights reserved.
 http://www.jaspersoft.com.

 Unless you have purchased a commercial license agreement from Jaspersoft,
 the following license terms apply:

 This program is free software: you can redistribute it and/or modify
 it under the terms of the GNU Affero General Public License as
 published by the Free Software Foundation, either version 3 of the
 License, or (at your option) any later version.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 GNU Affero  General Public License for more details.

 You should have received a copy of the GNU Affero General Public  License
 along with this program. If not, see <http://www.gnu.org/licenses/>.

=========================================================================== */
namespace Jasper;

/** Jasper\Attribute class
 * this class represents Attributes from the JasperServer and contains data that is
 * accessible via the user service in the REST API.
 *
 * author: gbacon
 * date: 06/13/2012
 */
class Attribute {

	public $Item;

	/**
     * Constructor
	 *
	 * To use this function provide an array in the format array('attributeName' => 'attributeValue').
	 * @param string $name - name of attribute
	 * @param string $value - value of attribute
	 */
	public function __construct($name, $value)
	{
		$dataArray = array(
		'name' => $name,
		'value' => $value,
		'_attributes' => array('xsi:type' => 'profileAttributeImpl', 'xmlns:xsi' => 'http://www.w3.org/2001/XMLSchema-instance')	// required attributes for descriptor
		);
		$this->Item = $dataArray;
	}

	public function getName() { return $this->Item['name']; }
	public function getValue() { return $this->Item['value']; }

	public function setName($name) { $this->Item['name'] = $name; }
	public function setValue($value) { $this->Item['value'] = $value; }


	public function asXML() {
		$seri_opt = array(
			'indent' => '     ',
			'rootName' => 'entityResource',
			'ignoreNull' => true,
			'attributesArray' => '_attributes'	// see Serializer docs
			);
		$seri = new \XML_Serializer($seri_opt);
		$res = $seri->serialize($this);
		if ($res === true) {
			return $seri->getSerializedData();
		} else {
			return false;
		}
	}

	public function __toString() {
		return htmlentities($this->asXML());
	}
}

?>
