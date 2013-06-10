<?php

namespace MyApp\Model\Manager\IManager{
	interface IManager{
		function getDB();
		function getCollection();
	}
}