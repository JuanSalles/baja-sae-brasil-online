<?php

namespace Baja\Model\Map;

use Baja\Model\Equipe;
use Baja\Model\EquipeQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'equipe' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class EquipeTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Baja.Model.Map.EquipeTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'resultados';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'equipe';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Baja\\Model\\Equipe';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Baja.Model.Equipe';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 9;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 9;

    /**
     * the column name for the evento_id field
     */
    const COL_EVENTO_ID = 'equipe.evento_id';

    /**
     * the column name for the equipe_id field
     */
    const COL_EQUIPE_ID = 'equipe.equipe_id';

    /**
     * the column name for the escola field
     */
    const COL_ESCOLA = 'equipe.escola';

    /**
     * the column name for the escola_curto field
     */
    const COL_ESCOLA_CURTO = 'equipe.escola_curto';

    /**
     * the column name for the cidade field
     */
    const COL_CIDADE = 'equipe.cidade';

    /**
     * the column name for the equipe field
     */
    const COL_EQUIPE = 'equipe.equipe';

    /**
     * the column name for the equipe_curto field
     */
    const COL_EQUIPE_CURTO = 'equipe.equipe_curto';

    /**
     * the column name for the estado field
     */
    const COL_ESTADO = 'equipe.estado';

    /**
     * the column name for the presente field
     */
    const COL_PRESENTE = 'equipe.presente';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('EventoId', 'EquipeId', 'Escola', 'EscolaCurto', 'Cidade', 'Equipe', 'EquipeCurto', 'Estado', 'Presente', ),
        self::TYPE_CAMELNAME     => array('eventoId', 'equipeId', 'escola', 'escolaCurto', 'cidade', 'equipe', 'equipeCurto', 'estado', 'presente', ),
        self::TYPE_COLNAME       => array(EquipeTableMap::COL_EVENTO_ID, EquipeTableMap::COL_EQUIPE_ID, EquipeTableMap::COL_ESCOLA, EquipeTableMap::COL_ESCOLA_CURTO, EquipeTableMap::COL_CIDADE, EquipeTableMap::COL_EQUIPE, EquipeTableMap::COL_EQUIPE_CURTO, EquipeTableMap::COL_ESTADO, EquipeTableMap::COL_PRESENTE, ),
        self::TYPE_FIELDNAME     => array('evento_id', 'equipe_id', 'escola', 'escola_curto', 'cidade', 'equipe', 'equipe_curto', 'estado', 'presente', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('EventoId' => 0, 'EquipeId' => 1, 'Escola' => 2, 'EscolaCurto' => 3, 'Cidade' => 4, 'Equipe' => 5, 'EquipeCurto' => 6, 'Estado' => 7, 'Presente' => 8, ),
        self::TYPE_CAMELNAME     => array('eventoId' => 0, 'equipeId' => 1, 'escola' => 2, 'escolaCurto' => 3, 'cidade' => 4, 'equipe' => 5, 'equipeCurto' => 6, 'estado' => 7, 'presente' => 8, ),
        self::TYPE_COLNAME       => array(EquipeTableMap::COL_EVENTO_ID => 0, EquipeTableMap::COL_EQUIPE_ID => 1, EquipeTableMap::COL_ESCOLA => 2, EquipeTableMap::COL_ESCOLA_CURTO => 3, EquipeTableMap::COL_CIDADE => 4, EquipeTableMap::COL_EQUIPE => 5, EquipeTableMap::COL_EQUIPE_CURTO => 6, EquipeTableMap::COL_ESTADO => 7, EquipeTableMap::COL_PRESENTE => 8, ),
        self::TYPE_FIELDNAME     => array('evento_id' => 0, 'equipe_id' => 1, 'escola' => 2, 'escola_curto' => 3, 'cidade' => 4, 'equipe' => 5, 'equipe_curto' => 6, 'estado' => 7, 'presente' => 8, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('equipe');
        $this->setPhpName('Equipe');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Baja\\Model\\Equipe');
        $this->setPackage('Baja.Model');
        $this->setUseIdGenerator(false);
        // columns
        $this->addForeignPrimaryKey('evento_id', 'EventoId', 'CHAR' , 'evento', 'evento_id', true, 4, null);
        $this->addPrimaryKey('equipe_id', 'EquipeId', 'INTEGER', true, null, null);
        $this->addColumn('escola', 'Escola', 'VARCHAR', true, 100, null);
        $this->addColumn('escola_curto', 'EscolaCurto', 'VARCHAR', true, 100, null);
        $this->addColumn('cidade', 'Cidade', 'VARCHAR', true, 100, null);
        $this->addColumn('equipe', 'Equipe', 'VARCHAR', true, 100, null);
        $this->addColumn('equipe_curto', 'EquipeCurto', 'VARCHAR', true, 100, null);
        $this->addColumn('estado', 'Estado', 'CHAR', false, 2, null);
        $this->addColumn('presente', 'Presente', 'BOOLEAN', true, 1, true);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Evento', '\\Baja\\Model\\Evento', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':evento_id',
    1 => ':evento_id',
  ),
), 'CASCADE', 'CASCADE', null, false);
        $this->addRelation('Input', '\\Baja\\Model\\Input', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':evento_id',
    1 => ':evento_id',
  ),
  1 =>
  array (
    0 => ':equipe_id',
    1 => ':equipe_id',
  ),
), 'CASCADE', 'CASCADE', 'Inputs', false);
        $this->addRelation('Tournament', '\\Baja\\Model\\Tournament', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':evento_id',
    1 => ':evento_id',
  ),
  1 =>
  array (
    0 => ':winner',
    1 => ':equipe_id',
  ),
), 'CASCADE', 'CASCADE', 'Tournaments', false);
        $this->addRelation('Senha', '\\Baja\\Model\\Senha', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':equipe_id',
    1 => ':equipe_id',
  ),
  1 =>
  array (
    0 => ':evento_id',
    1 => ':evento_id',
  ),
), 'CASCADE', 'CASCADE', 'Senhas', false);
    } // buildRelations()

    /**
     * Adds an object to the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database. In some cases you may need to explicitly add objects
     * to the cache in order to ensure that the same objects are always returned by find*()
     * and findPk*() calls.
     *
     * @param \Baja\Model\Equipe $obj A \Baja\Model\Equipe object.
     * @param string $key             (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (null === $key) {
                $key = serialize([(null === $obj->getEventoId() || is_scalar($obj->getEventoId()) || is_callable([$obj->getEventoId(), '__toString']) ? (string) $obj->getEventoId() : $obj->getEventoId()), (null === $obj->getEquipeId() || is_scalar($obj->getEquipeId()) || is_callable([$obj->getEquipeId(), '__toString']) ? (string) $obj->getEquipeId() : $obj->getEquipeId())]);
            } // if key === null
            self::$instances[$key] = $obj;
        }
    }

    /**
     * Removes an object from the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database.  In some cases -- especially when you override doDelete
     * methods in your stub classes -- you may need to explicitly remove objects
     * from the cache in order to prevent returning objects that no longer exist.
     *
     * @param mixed $value A \Baja\Model\Equipe object or a primary key value.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && null !== $value) {
            if (is_object($value) && $value instanceof \Baja\Model\Equipe) {
                $key = serialize([(null === $value->getEventoId() || is_scalar($value->getEventoId()) || is_callable([$value->getEventoId(), '__toString']) ? (string) $value->getEventoId() : $value->getEventoId()), (null === $value->getEquipeId() || is_scalar($value->getEquipeId()) || is_callable([$value->getEquipeId(), '__toString']) ? (string) $value->getEquipeId() : $value->getEquipeId())]);

            } elseif (is_array($value) && count($value) === 2) {
                // assume we've been passed a primary key";
                $key = serialize([(null === $value[0] || is_scalar($value[0]) || is_callable([$value[0], '__toString']) ? (string) $value[0] : $value[0]), (null === $value[1] || is_scalar($value[1]) || is_callable([$value[1], '__toString']) ? (string) $value[1] : $value[1])]);
            } elseif ($value instanceof Criteria) {
                self::$instances = [];

                return;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or \Baja\Model\Equipe object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value, true)));
                throw $e;
            }

            unset(self::$instances[$key]);
        }
    }
    /**
     * Method to invalidate the instance pool of all tables related to equipe     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        InputTableMap::clearInstancePool();
        TournamentTableMap::clearInstancePool();
        SenhaTableMap::clearInstancePool();
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EventoId', TableMap::TYPE_PHPNAME, $indexType)] === null && $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('EquipeId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return serialize([(null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EventoId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EventoId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EventoId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EventoId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EventoId', TableMap::TYPE_PHPNAME, $indexType)]), (null === $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('EquipeId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('EquipeId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('EquipeId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('EquipeId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('EquipeId', TableMap::TYPE_PHPNAME, $indexType)])]);
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
            $pks = [];

        $pks[] = (string) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('EventoId', TableMap::TYPE_PHPNAME, $indexType)
        ];
        $pks[] = (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 1 + $offset
                : self::translateFieldName('EquipeId', TableMap::TYPE_PHPNAME, $indexType)
        ];

        return $pks;
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? EquipeTableMap::CLASS_DEFAULT : EquipeTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (Equipe object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = EquipeTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = EquipeTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + EquipeTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = EquipeTableMap::OM_CLASS;
            /** @var Equipe $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            EquipeTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = EquipeTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = EquipeTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Equipe $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                EquipeTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(EquipeTableMap::COL_EVENTO_ID);
            $criteria->addSelectColumn(EquipeTableMap::COL_EQUIPE_ID);
            $criteria->addSelectColumn(EquipeTableMap::COL_ESCOLA);
            $criteria->addSelectColumn(EquipeTableMap::COL_ESCOLA_CURTO);
            $criteria->addSelectColumn(EquipeTableMap::COL_CIDADE);
            $criteria->addSelectColumn(EquipeTableMap::COL_EQUIPE);
            $criteria->addSelectColumn(EquipeTableMap::COL_EQUIPE_CURTO);
            $criteria->addSelectColumn(EquipeTableMap::COL_ESTADO);
            $criteria->addSelectColumn(EquipeTableMap::COL_PRESENTE);
        } else {
            $criteria->addSelectColumn($alias . '.evento_id');
            $criteria->addSelectColumn($alias . '.equipe_id');
            $criteria->addSelectColumn($alias . '.escola');
            $criteria->addSelectColumn($alias . '.escola_curto');
            $criteria->addSelectColumn($alias . '.cidade');
            $criteria->addSelectColumn($alias . '.equipe');
            $criteria->addSelectColumn($alias . '.equipe_curto');
            $criteria->addSelectColumn($alias . '.estado');
            $criteria->addSelectColumn($alias . '.presente');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(EquipeTableMap::DATABASE_NAME)->getTable(EquipeTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(EquipeTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(EquipeTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new EquipeTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Equipe or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Equipe object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EquipeTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Baja\Model\Equipe) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(EquipeTableMap::DATABASE_NAME);
            // primary key is composite; we therefore, expect
            // the primary key passed to be an array of pkey values
            if (count($values) == count($values, COUNT_RECURSIVE)) {
                // array is not multi-dimensional
                $values = array($values);
            }
            foreach ($values as $value) {
                $criterion = $criteria->getNewCriterion(EquipeTableMap::COL_EVENTO_ID, $value[0]);
                $criterion->addAnd($criteria->getNewCriterion(EquipeTableMap::COL_EQUIPE_ID, $value[1]));
                $criteria->addOr($criterion);
            }
        }

        $query = EquipeQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            EquipeTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                EquipeTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the equipe table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return EquipeQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Equipe or Criteria object.
     *
     * @param mixed               $criteria Criteria or Equipe object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EquipeTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Equipe object
        }


        // Set the correct dbName
        $query = EquipeQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // EquipeTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
EquipeTableMap::buildTableMap();
