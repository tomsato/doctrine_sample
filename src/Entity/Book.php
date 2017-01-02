<?php

namespace Sample\Entity;

/**
 * @Entity
 * @Table(name="BOOK")
 */
class Book
{
	/**
	 * @Id
	 * @Column (
	 * 	type="string",
	 *  name="book_id"
	 * )
	 */
	 public $book_id;

	/**
	 * @Column (
	 * 	type="string",
	 *  name="name"
	 * )
	 */
	 public $name;

	/**
	 * @Column (
	 * 	type="datetime",
	 *  name="created_date"
	 * )
	 */
	 public $created_date;
}
