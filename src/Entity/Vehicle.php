<?php

namespace Drupal\vehicle\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\vehicle\VehicleInterface;

/**
 * Defines the Vehicle entity.
 *
 *
 * @ContentEntityType(
 *   id = "vehicle",
 *   label = @Translation("Vehicle entity"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\vehicle\Entity\Controller\VehicleListBuilder",
 *     "views_data" = "Drupal\vehicle\VehicleViewsData",
 *     "form" = {
 *       "add" = "Drupal\vehicle\Form\VehicleForm",
 *       "edit" = "Drupal\vehicle\Form\VehicleForm",
 *       "delete" = "Drupal\vehicle\Form\VehicleDeleteForm",
 *     },
 *     "access" = "Drupal\vehicle\VehicleAccessControlHandler",
 *   },
 *   list_cache_contexts = { "user" },
 *   base_table = "vehicle",
 *   admin_permission = "administer vehicle entity",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "title",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/vehicle/{vehicle}",
 *     "edit-form" = "/vehicle/{vehicle}/edit",
 *     "delete-form" = "/vehicle/{vehicle}/delete",
 *     "collection" = "/vehicle/list"
 *   },
 *   field_ui_base_route = "vehicle.vehicle_settings",
 * )
 *
 */
class Vehicle extends ContentEntityBase implements VehicleInterface {


  /**
   * {@inheritdoc}
   *
   * When a new entity instance is added, set the user_id entity reference to
   * the current user as the creator of the instance.
   */
  public static function preCreate(EntityStorageInterface $storage_controller, array &$values) {
    parent::preCreate($storage_controller, $values);
//    $values += array(
//      'user_id' => \Drupal::currentUser()->id(),
//    );
  }


  /**
   * {@inheritdoc}
   *
   * Define the field properties here.
   *
   * Field name, type and size determine the table structure.
   *
   * In addition, we can define how the field and its content can be manipulated
   * in the GUI. The behaviour of the widgets used can be determined here.
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {

    // Standard field, used as unique if primary index.
    $fields['id'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('ID'))
      ->setDescription(t('The ID of the Vehicle entity.'))
      ->setReadOnly(TRUE);

    // Standard field, unique outside of the scope of the current project.
    $fields['uuid'] = BaseFieldDefinition::create('uuid')
      ->setLabel(t('UUID'))
      ->setDescription(t('The UUID of the Vehicle entity.'))
      ->setReadOnly(TRUE);

    //A title
    $fields['title'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Title'))
      ->setDescription(t('The title.'))
      ->setSettings(array(
        'default_value' => '',
        'max_length' => 255,
        'text_processing' => 0,
      ))
      ->setDisplayOptions('view', array(
        'label' => 'hidden',
        'type' => 'string',
        'weight' => -6,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'string_textfield',
        'weight' => -6,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    //A description
    $fields['description'] = BaseFieldDefinition::create('string_long')
      ->setLabel(t('Description'))
      ->setDescription(t('The description.'))
      ->setDisplayOptions('form', array(
        'type' => 'string_textarea',
        'weight' => 0,
        'settings' => array(
          'rows' => 4,
        ),
      ))
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'string',
        'weight' => -6,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    return $fields;
  }

}
