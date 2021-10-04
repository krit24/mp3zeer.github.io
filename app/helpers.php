<?php

/*
 * check permission
 * and hide if fails
 */
 
if( ! function_exists('hasAccess') ){
	function hasAccess( $alias = '' ){
		
		$user = Sentry::getUser();
		
		if ( ! $user->hasAccess($alias) ) return false;
		
		return true;
		
	}
}

/*
 * to compile the array into
 * one dimentional Array
 */

if( ! function_exists('_compile_array') ){
    function _compile_array( $data = array(), $default = '' ){

        $arr = array(
                '' => $default
            );

        foreach ($data as $key => $value) {
            $arr[$value->value] = $value->text;
        }

        return $arr;

    }
}

/*
 * get logged user info
 */

if( ! function_exists('_user') ){
    function _user(){

        return Sentry::getUser();

    }
}

/*
 * Getting
 * response messages
 * 
 */
if ( ! function_exists('get_message'))
{
	function get_message(){

		$msg = '';

		if( Session::get('error') ){
			$msg .= '<div id="resp_msg" class="error-msg">';
			$msg .= Session::get('error');
			$msg .= '</div>';
		}
		elseif( Session::get('success') ){
			$msg .= '<div id="resp_msg" class="success">';
			$msg .= Session::get('success');
			$msg .= '</div>';
		}
		
		echo $msg;
		
	}
}

/**
 * Set error message as session flashdata.
 * 
 * @access public
 * @param string
 * @return boolean
 */
if ( ! function_exists('_error'))
{
    function _error($msg = NULL)
    {
        if (empty($msg)) $msg = trans('validation.custom.cms_error');
        
        _message($msg, 'error');
        
        return TRUE;
    }
}

/**
 * Set success message as session flashdata
 * 
 * @access public
 * @param string
 * @return boolean
 */
if ( ! function_exists('_success'))
{
    function _success($msg = NULL)
    {
        if (empty($msg)) $msg = trans('validation.custom.cms_success');
        
        _message($msg, 'success');
        
        return TRUE;
    }
}

/**
 * Set message as flashdata. 
 * Messages can be an error or success message.
 * 
 * @access public
 * @param string
 * @param string
 * @return boolean
 */
if ( ! function_exists('_message'))
{
    function _message($msg = NULL, $type = 'success')
    {
        Session::flash($type, $msg);
        
        return TRUE;
    }
}

/*
 * get_permission
 *
 * Use to get the 
 * permission of the selected
 * "as".
 * 
 * @params
 * @return Boolean
 */

if ( ! function_exists('_get_permission'))
{
    function _get_permission($as = '')
    {

        $user = Sentry::getUser();

        if ( ! $user->hasAccess($as) ) return false;

        return true;
    }
}
