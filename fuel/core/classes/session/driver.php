<?php
/**
 * Part of the Fuel framework.
 *
 * @package    Fuel
 * @version    1.0
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2012 Fuel Development Team
 * @link       http://fuelphp.com
 */

namespace Fuel\Core;



abstract class Session_Driver
{

	/*
	 * @var	session class configuration
	 */
	protected $config = array();

	/*
	 * @var	session indentification keys
	 */
	protected $keys = array();

	/*
	 * @var	session variable data
	 */
	protected $data = array();

	/*
	 * @var	session flash data
	 */
	protected $flash = array();

	/*
	 * @var	session time object
	 */
	protected $time = null;

	// --------------------------------------------------------------------
	// abstract methods
	// --------------------------------------------------------------------

	/**
	 * create a new session
	 *
	 * @access	public
	 * @return	void
	 */
	abstract function create();

	// --------------------------------------------------------------------

	/**
	 * destroy the current session
	 *
	 * @access	public
	 * @return	void
	 */
	abstract function destroy();

	// --------------------------------------------------------------------
	// generic driver methods
	// --------------------------------------------------------------------

	/**
	 * read the session
	 *
	 * @access	public
	 * @return	Fuel\Core\Session_Driver
	 */
	public function read()
	{
		// auto expire flash variables if needed
		if ($this->config['flash_auto_expire'] === true)
		{
			foreach($this->flash as $key => $value)
			{
				$this->flash[$key]['state'] = 'old';
			}
		}

		return $this;
	}

	// --------------------------------------------------------------------

	/**
	 * write the session
	 *
	 * @access	public
	 * @return	Fuel\Core\Session_Driver
	 */
	public function write()
	{
		$this->_cleanup_flash();

		return $this;
	}

	// --------------------------------------------------------------------

	/**
	 * generic driver initialisation
	 *
	 * @access	public
	 * @return	void
	 */
	public function init()
	{
		// get a time object
		$this->time = \Date::time();
	}

	// --------------------------------------------------------------------

	/**
	 * set session variables
	 *
	 * @param	string|array	name of the variable to set or array of values, array(name => value)
	 * @param	mixed			value
	 * @access	public
	 * @return	Fuel\Core\Session_Driver
	 */
	public function set($name, $value = null)
	{
		is_null($name) or \Arr::set($this->data, $name, $value);

		return $this;
	}

	// --------------------------------------------------------------------

	/**
	 * get session variables
	 *
	 * @access	public
	 * @param	string	name of the variable to get
	 * @param	mixed	default value to return if the variable does not exist
	 * @return	mixed
	 */
	public function get($name, $default = null)
	{
		if (is_null($name))
		{
			return $this->data;
		}
		return \Arr::get($this->data, $name, $default);
	}

	// --------------------------------------------------------------------

	/**
	 * get session key variables
	 *
	 * @access	public
	 * @param	string	name of the variable to get, default is 'session_id'
	 * @return	mixed	contents of the requested variable, or false if not found
	 */
	public function key($name = 'session_id')
	{
		return isset($this->keys[$name]) ? $this->keys[$name] : false;
	}

	// --------------------------------------------------------------------

	/**
	 * delete session variables
	 *
	 * @param	string	name of the variable to delete
	 * @param	mixed	value
	 * @access	public
	 * @return	Fuel\Core\Session_Driver
	 */
	public function delete($name)
	{
		\Arr::delete($this->data, $name);

		return $this;
	}

	// --------------------------------------------------------------------

	/**
	 * force a session_id rotation
	 *
	 * @access	public
	 * @param	boolean, if true, force a session id rotation
	 * @return  Fuel\Core\Session_Driver
	 */
	public function rotate($force = true)
	{
		// do we have a session?
		if ( ! empty($this->keys))
		{
			// existing session. need to rotate the session id?
			if ($force or ($this->config['rotation_time'] and $this->keys['created'] + $this->config['rotation_time'] <= $this->time->get_timestamp()))
			{
				// generate a new session id, and update the create timestamp
				$this->keys['previous_id']	= $this->keys['session_id'];
				$this->keys['session_id']	= $this->_new_session_id();
				$this->keys['created'] 		= $this->time->get_timestamp();
				$this->keys['updated']		= $this->keys['created'];
			}
		}

		return $this;
	}

	// --------------------------------------------------------------------

	/**
	 * set session flash variables
	 *
	 * @param	string	name of the variable to set
	 * @param	mixed	value
	 * @access	public
	 * @return	Fuel\Core\Session_Driver
	 */
	public function set_flash($name, $value)
	{
		$this->flash[$this->config['flash_id'].'::'.$name] = array('state' => 'new', 'value' => $value);

		return $this;
	}

	// --------------------------------------------------------------------

	/**
	 * get session flash variables
	 *
	 * @access	public
	 * @param	string	name of the variable to get
	 * @param	mixed	default value to return if the variable does not exist
	 * @return	mixed
	 */
	public function get_flash($name, $default = null)
	{
		if (is_null($name))
		{
			$default = array();
			foreach($this->flash as $key => $value)
			{
				$key = substr($key, strpos($key, '::')+2);
				$default[$key] = $value;
			}
		}
		elseif (isset($this->flash[$this->config['flash_id'].'::'.$name]))
		{
			$this->flash[$this->config['flash_id'].'::'.$name]['state'] = 'old';
			$default = $this->flash[$this->config['flash_id'].'::'.$name]['value'];
		}

		return ($default instanceof \Closure) ? $default() : $default;
	}

	// --------------------------------------------------------------------

	/**
	 * keep session flash variables
	 *
	 * @access	public
	 * @param	string	name of the variable to keep
	 * @return	Fuel\Core\Session_Driver
	 */
	public function keep_flash($name)
	{
		if (is_null($name))
		{
			foreach($this->flash as $key => $value)
			{
				$this->flash[$key]['state'] = 'new';
			}
		}
		elseif (isset($this->flash[$this->config['flash_id'].'::'.$name]))
		{
			$this->flash[$this->config['flash_id'].'::'.$name]['state'] = 'new';
		}

		return $this;
	}

	// --------------------------------------------------------------------

	/**
	 * delete session flash variables
	 *
	 * @param	string	name of the variable to delete
	 * @param	mixed	value
	 * @access	public
	 * @return	Fuel\Core\Session_Driver
	 */
	public function delete_flash($name)
	{
		if (is_null($name))
		{
			$this->flash = array();
		}
		elseif (isset($this->flash[$this->config['flash_id'].'::'.$name]))
		{
			unset($this->flash[$this->config['flash_id'].'::'.$name]);
		}

		return $this;
	}

	// --------------------------------------------------------------------

	/**
	 * set the session flash id
	 *
	 * @param	string	name of the id to set
	 * @access	public
	 * @return	Fuel\Core\Session_Driver
	 */
	public function set_flash_id($name)
	{
		$this->config['flash_id'] = (string) $name;

		return $this;
	}

	// --------------------------------------------------------------------

	/**
	 * get the current session flash id
	 *
	 * @access	public
	 * @return	string	name of the flash id
	 */
	public function get_flash_id()
	{
		return $this->config['flash_id'];
	}

	// --------------------------------------------------------------------

	/**
	 * get a runtime config value
	 *
	 * @param	string	name of the config variable to get
	 * @access	public
	 * @return  mixed
	 */
	public function get_config($name)
	{
		return isset($this->config[$name]) ? $this->config[$name] : null;
	}

	// --------------------------------------------------------------------

	/**
	 * set a runtime config value
	 *
	 * @param	string	name of the config variable to set
	 * @access	public
	 * @return  Fuel\Core\Session_Driver
	 */
	public function set_config($name, $value = null)
	{
		if (isset($this->config[$name])) $this->config[$name] = $value;

		return $this;
	}

	// --------------------------------------------------------------------

	/**
	 * removes flash variables marked as old
	 *
	 * @access	private
	 * @return  void
	 */
	protected function _cleanup_flash()
	{
		foreach($this->flash as $key => $value)
		{
			if ($value['state'] === 'old')
			{
				unset($this->flash[$key]);
			}
		}
	}

	// --------------------------------------------------------------------

	/**
	 * generate a new session id
	 *
	 * @access	private
	 * @return  void
	 */
	protected function _new_session_id()
	{
		$session_id = '';
		while (strlen($session_id) < 32)
		{
			$session_id .= mt_rand(0, mt_getrandmax());
		}
		return md5(uniqid($session_id, TRUE));
	}

	// --------------------------------------------------------------------

	/**
	 * write a cookie
	 *
	 * @access	private
	 * @param	array, cookie payload
	 * @return  void
	 */
	 protected function _set_cookie($payload = array())
	 {
		// record the last update time of the session
		$this->keys['updated'] = $this->time->get_timestamp();

		// add the session keys to the payload
		array_unshift($payload, $this->keys);

		// encrypt the payload
		$payload = \Crypt::encode($this->_serialize($payload));

		// make sure it doesn't exceed the cookie size specification
		if (strlen($payload) > 4000)
		{
			throw new \FuelException('The session data stored by the application in the cookie exceeds 4Kb. Select a different session storage driver.');
		}

		// write the session cookie
		if ($this->config['expire_on_close'])
		{
			return \Cookie::set($this->config['cookie_name'], $payload, 0, $this->config['cookie_path'], $this->config['cookie_domain'], null, $this->config['cookie_http_only']);
		}
		else
		{
			return \Cookie::set($this->config['cookie_name'], $payload, $this->config['expiration_time'], $this->config['cookie_path'], $this->config['cookie_domain'], null, $this->config['cookie_http_only']);
		}
	}

	// --------------------------------------------------------------------

	/**
	 * read a cookie
	 *
	 * @access	private
	 * @return  void
	 */
	 protected function _get_cookie()
	 {
		// was the cookie posted?
		$cookie = \Input::cookie($this->config['post_cookie_name'], false);

		// if not found, fetch the regular cookie
		if ($cookie === false)
		{
			$cookie = \Cookie::get($this->config['cookie_name'], false);
		}

		if ($cookie !== false)
		{
			// fetch the payload
			$cookie = $this->_unserialize(\Crypt::decode($cookie));

			// validate the cookie
			if ( ! isset($cookie[0]) )
			{
				// not a valid cookie payload
			}
			elseif ($cookie[0]['updated'] + $this->config['expiration_time'] <= $this->time->get_timestamp())
			{
				// session has expired
			}
			elseif ($this->config['match_ip'] and $cookie[0]['ip_hash'] !== md5(\Input::ip().\Input::real_ip()))
			{
				// IP address doesn't match
			}
			elseif ($this->config['match_ua'] and $cookie[0]['user_agent'] !== \Input::user_agent())
			{
				// user agent doesn't match
			}
			else
			{
				// session is valid, retrieve the session keys
				if (isset($cookie[0])) $this->keys = $cookie[0];

				// and return the cookie payload
				array_shift($cookie);
				return $cookie;
			}
		}

		// no payload
		return false;
	 }

	// --------------------------------------------------------------------

	/**
	 * Serialize an array
	 *
	 * This function first converts any slashes found in the array to a temporary
	 * marker, so when it gets unserialized the slashes will be preserved
	 *
	 * @access	private
	 * @param	array
	 * @return	string
	 */
	protected function _serialize($data)
	{
		if (is_array($data))
		{
			foreach ($data as $key => $val)
			{
				if (is_string($val))
				{
					$data[$key] = str_replace('\\', '{{slash}}', $val);
				}
			}
		}
		else
		{
			if (is_string($data))
			{
				$data = str_replace('\\', '{{slash}}', $data);
			}
		}

		return serialize($data);
	}

	// --------------------------------------------------------------------

	/**
	 * Unserialize
	 *
	 * This function unserializes a data string, then converts any
	 * temporary slash markers back to actual slashes
	 *
	 * @access	private
	 * @param	array
	 * @return	string
	 */
	protected function _unserialize($data)
	{
		$data = @unserialize($data);

		if (is_array($data))
		{
			foreach ($data as $key => $val)
			{
				if (is_string($val))
				{
					$data[$key] = str_replace('{{slash}}', '\\', $val);
				}
			}

			return $data;
		}

		return (is_string($data)) ? str_replace('{{slash}}', '\\', $data) : $data;
	}

	// --------------------------------------------------------------------

	/**
	 * validate__config
	 *
	 * This function validates all global (driver independent) configuration values
	 *
	 * @access	private
	 * @param	array
	 * @return	array
	 */
	protected function _validate_config($config)
	{
		$validated = array();

		foreach ($config as $name => $item)
		{
			switch($name)
			{
				case 'driver':
					// if we get here, this one was ok... ;-)
				break;

				case 'match_ip':
					// make sure it's a boolean
					$item = (bool) $item;
				break;

				case 'match_ua':
					// make sure it's a boolean
					$item = (bool) $item;
				break;

				case 'cookie_domain':
					// make sure it's a string
					$item = (string) $item;
				break;

				case 'cookie_path':
					// make sure it's a string
					$item = (string) $item;
					if (empty($item))
					{
						$item = '/';
					}
				break;

				case 'cookie_http_only':
					// make sure it's a boolean
					$item = (bool) $item;
				break;

				case 'expire_on_close':
					// make sure it's a boolean
					$item = (bool) $item;
				break;

				case 'expiration_time':
					// make sure it's an integer
					$item = (int) $item;
					if ($item <= 0)
					{
						// invalid? set it to two years from now
						$item = 86400 * 365 * 2;
					}
				break;

				case 'rotation_time':
					// make sure it's an integer
					$item = (int) $item;
					if ($item <= 0)
					{
						// invalid? set it to 5 minutes
						$item = 300;
					}
				break;

				case 'flash_id':
					// make sure it's a string
					$item = (string) $item;
					if (empty($item))
					{
						$item = 'flash';
					}
				break;

				case 'flash_auto_expire':
					// make sure it's a boolean
					$item = (bool) $item;
				break;

				case 'post_cookie_name':
					// make sure it's a string
					$item = (string) $item;
				break;

				default:
					// ignore this setting
				break;

			}

			// store the validated result
			$validated[$name] = $item;
		}

		return $validated;
	}

}


