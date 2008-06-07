<?php
// vim: foldmethod=marker
/**
 *  Ethna_Plugin_Validator_StrMax_Test.php
 */

/**
 *  Ethna_Plugin_Validator_StrMaxクラスのテストケース
 *
 *  @access public
 */
class Ethna_Plugin_Validator_StrMax_Test extends Ethna_UnitTestBase
{
    var $vld;

    function setUp()
    {
        $ctl =& Ethna_Controller::getInstance();
        $plugin =& $ctl->getPlugin();
        $this->vld = $plugin->getPlugin('Validator', 'StrMax');
    }

    // {{{ test max str 
    function test_max_str()
    {
        $form_str = array(
                          'type'          => VAR_TYPE_STRING,
                          'required'      => true,
                          'strmax'      => '3',
                          );
        $this->vld->af->setDef('namae_mbstr', $form_str);

        $pear_error = $this->vld->validate('namae_mbstr', 'abc', $form_str);
        $this->assertFalse(is_a($pear_error, 'PEAR_Error'));

        $pear_error = $this->vld->validate('namae_mbstr', 'abcd', $form_str);
        $this->assertTrue(is_a($pear_error, 'PEAR_Error'));
        $this->assertEqual(E_FORM_MAX_STRING,$pear_error->getCode());

        //  TODO: Error Message Test.
    } 
    // }}}

}

?>
