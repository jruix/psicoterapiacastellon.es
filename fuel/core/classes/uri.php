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

/**
 * Uri Class
 *
 * @package   Fuel
 * @category  Core
 * @author    Dan Horrigan
 * @link      http://docs.fuelphp.com/classes/uri.html
 */
class Uri
{

	/**
	 * Returns the desired segment, or $default if it does not exist.
	 *
	 * @param   int     $segment  The segment number (1-based index)
	 * @param   mixed   $default  Default value to return
	 * @return  string
	 */
	public static function segment($segment, $default = null)
	{
		if ($request = \Request::active())
		{
			return $request->uri->get_segment($segment, $default);
		}

		return null;
	}

	/**
	 * Returns all segments in an array
	 *
	 * @return  array
	 */
	public static function segments()
	{
		if ($request = \Request::active())
		{
			return $request->uri->get_segments();
		}

		return null;
	}

	/**
	 * Converts the current URI segments to an associative array.  If
	 * the URI has an odd number of segments, an exception will be thrown.
	 *
	 * @return  array|null  the array or null
	 */
	public static function to_assoc()
	{
		return \Arr::to_assoc(static::segments());
	}

	/**
	 * Returns the full uri as a string
	 *
	 * @return  string
	 */
	public static function string()
	{
		if ($request = \Request::active())
		{
			return $request->uri->get();
		}

		return null;
	}

	/**
	 * Creates a url with the given uri, including the base url
	 *
	 * @param   string  $uri            The uri to create the URL for
	 * @param   array   $variables      Some variables for the URL
	 * @param   array   $get_variables  Any GET urls to append via a query string
	 * @param   bool    $secure         If false, force http. If true, force https
	 * @return  string
	 */
	public static function create($uri = null, $variables = array(), $get_variables = array(), $secure = null)
	{
		$url = '';
		$uri = $uri ?: static::string();

		// If the given uri is not a full URL
		if( ! preg_match("#^(http|https|ftp)://#i", $uri))
		{
			$url .= \Config::get('base_url');

			if ($index_file = \Config::get('index_file'))
			{
				$url .= $index_file.'/';
			}
		}
		$url .= ltrim($uri, '/');

		// Add a url_suffix if defined and the url doesn't already have one
		if (substr($url, -1) != '/' and (($suffix = strrchr($url, '.')) === false or strlen($suffix) > 5))
		{
			\Config::get('url_suffix') and $url .= \Config::get('url_suffix');
		}

		if ( ! empty($get_variables))
		{
			$char = strpos($url, '?') === false ? '?' : '&';
			if (is_string($get_variables))
			{
				$url .= $char.str_replace('%3A', ':', $get_variables);
			}
			else
			{
				$url .= $char.str_replace('%3A', ':', http_build_query($get_variables));
			}
		}

		array_walk(
			$variables,
			function ($val, $key) use (&$url)
			{
				$url = str_replace(':'.$key, $val, $url);
			}
		);

		is_bool($secure) and $url = http_build_url($url, array('scheme' => $secure ? 'https' : 'http'));

		return $url;
	}

	/**
	 * Gets the main request's URI
	 *
	 * @return  string
	 */
	public static function main()
	{
		return static::create(\Request::main()->uri->get());
	}

	/**
	 * Gets the current URL, including the BASE_URL
	 *
	 * @return  string
	 */
	public static function current()
	{
		return static::create();
	}

	/**
	 * Gets the base URL, including the index_file if wanted.
	 *
	 * @param   bool    $include_index  Whether to include index.php in the URL
	 * @return  string
	 */
	public static function base($include_index = true)
	{
		$url = \Config::get('base_url');

		if ($include_index and \Config::get('index_file'))
		{
			$url .= \Config::get('index_file').'/';
		}

		return $url;
	}


	/**
	 * @var  string  The URI string
	 */
	protected $uri = '';

	/**
	 * @var  array  The URI segments
	 */
	protected $segments = '';

	/**
	 * Construct takes a URI or detects it if none is given and generates
	 * the segments.
	 *
	 * @param   string  The URI
	 * @return  void
	 */
	public function __construct($uri = null)
	{
		if (\Fuel::$profiling)
		{
			\Profiler::mark(__METHOD__.' Start');
		}

		// if the route is a closure, an object will be passed here
		is_object($uri) and $uri = null;

		$this->uri = trim($uri ?: \Input::uri(), '/');
		$this->segments = $this->uri === '' ? array() : explode('/', $this->uri);

		if (\Fuel::$profiling)
		{
			\Profiler::mark(__METHOD__.' End');
		}
	}

	/**
	 * Returns the full URI string
	 *
	 * @return  string  The URI string
	 */
	public function get()
	{
		return $this->uri;
	}

	/**
	 * Returns all of the URI segments
	 *
	 * @return  array  The URI segments
	 */
	public function get_segments()
	{
		return $this->segments;
	}

	/**
	 * Get the specified URI segment, return default if it doesn't exist.
	 *
	 * Segment index is 1 based, not 0 based
	 *
	 * @param   string  $segment  The 1-based segment index
	 * @param   mixed   $default  The default value
	 * @return  mixed
	 */
	public function get_segment($segment, $default = null)
	{
		if (isset($this->segments[$segment - 1]))
		{
			return $this->segments[$segment - 1];
		}

		return \Fuel::value($default);
	}

	/**
	 * Returns the URI string
	 *
	 * @return  string
	 */
	public function __toString()
	{
		return $this->get();
	}
}
