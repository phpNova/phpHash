<?php

/**
 * Satellite class for handling string hashing.
 */

class Hash
{
	public static function hash_string( $string, $hashtype, $allow_all = FALSE )
	{
		/* First, make sure the specified protocol is supported by the PHP install.  --Kris */
		switch ( $hashtype )
		{
			default:
				if ( $allow_all == FALSE 
					|| in_array( $hashtype, hash_algos() ) == FALSE )
				{
					return FALSE;
				}
				break;
			case "md5":
				if ( !function_exists( "md5" ) )
				{
					return FALSE;
				}
				break;
			case "sha1":
				if ( !function_exists( "sha1" ) )
				{
					return FALSE;
				}
				break;
			case "sha256":
			case "sha512":
				if ( !function_exists( "hash" ) 
					|| in_array( $hashtype, hash_algos() ) == FALSE )
				{
					return FALSE;
				}
				break;
		}
		
		/* Return the encrypted password and we're done!  --Kris */
		switch ( $hashtype )
		{
			default:
				if ( $allow_all == FALSE 
					|| in_array( $hashtype, hash_algos() ) == FALSE )
				{
					die( "ERROR!  Sanity check passed for hash_string but functionality for $passhash protocol not added!" );
				}
				else
				{
					return hash( $hashtype, $string );
				}
				break;
			case "md5":
				return md5( $string );
				break;
			case "sha1":
				return sha1( $string );
				break;
			case "sha256":
			case "sha512":
				return hash( $hashtype, $string );
				break;
		}
	}
}
