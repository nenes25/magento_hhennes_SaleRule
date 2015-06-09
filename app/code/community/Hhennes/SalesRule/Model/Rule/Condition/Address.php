<?php

/**
 * Hhennes SalesRules Helper
 *
 * @author Hhennes <contact@h-hennes.fr>
 * cf.http://magento.stackexchange.com/questions/9748/shopping-cart-price-rule-condition-based-on-final-price-rather-than-subtotal
 */
class Hhennes_SalesRule_Model_Rule_Condition_Address extends Mage_SalesRule_Model_Rule_Condition_Address {

    /**
     * (non-PHPdoc)
     * @see Mage_SalesRule_Model_Rule_Condition_Address::loadAttributeOptions()
     */
    public function loadAttributeOptions()
    {
        parent::loadAttributeOptions();

        $attributes = $this->getAttributeOption();
        $attributes['base_subtotal_with_discount'] = Mage::helper('hhennes_salesrule')->__('Subtotal with discount');
        $this->setAttributeOption($attributes);

        return $this;
    }


    /**
     * (non-PHPdoc)
     * @see Mage_SalesRule_Model_Rule_Condition_Address::getInputType()
     */
    public function getInputType()
    {
        if ($this->getAttribute() == 'base_subtotal_with_discount')
            return 'numeric';

        return parent::getInputType();
    }


    /**
     * Add field "base_subtotal_with_discount" to address.
     * It is need to validate the "base_subtotal_with_discount" attribute
     * 
     * @see Mage_SalesRule_Model_Rule_Condition_Address::validate()
     */
    public function validate(Varien_Object $address)
    {
        $address->setBaseSubtotalWithDiscount($address->getBaseSubtotal() + $address->getDiscountAmount());
        return parent::validate($address);
    }
}

?>
