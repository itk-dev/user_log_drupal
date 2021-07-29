<?php

namespace Drupal\itkdev_user_log\Helper;

use Drupal\Core\Entity\EntityInterface;
use Drupal\user\UserInterface;

class Helper
{

  /**
   * Implements hook_ENTITY_TYPE_delete().
   */
  public function userDelete(EntityInterface $entity)
  {
    if ($entity instanceof UserInterface) {

      \Drupal::database()->insert('itkdev_user_log')
        ->fields([
          'deleted_user_id' => $entity->id(),
          'deleted_at' => \Drupal::time()->getCurrentTime(),
          'deleted_by' => \Drupal::currentUser()->id(),
          'deleted_user_name' => $entity->getAccountName(),
          'deleted_user_mail' => $entity->getEmail(),
          'deleted_user' => serialize($entity),
        ])
        ->execute();
    }
  }

  public function viewsData()
  {
    $data = array();
    $data['itkdev_user_log'] = array();
    $data['itkdev_user_log']['table'] = array();
    $data['itkdev_user_log']['table']['group'] = t('User Delete Log');
    $data['itkdev_user_log']['table']['provider'] = 'itkdev_user_log';
    $data['itkdev_user_log']['table']['base'] = array(
      'field' => 'user_delete_log_id',
      'title' => t('User Delete Log'),
      'help' => t('The User Delete Log Table'),
    );

    $data['itkdev_user_log']['user_delete_log_id'] = array(
      'title' => t('User Delete Log ID'),
      'help' => t('The User Delete Log ID'),
      'field' => array(
        // ID of field handler plugin to use.
        'id' => 'numeric',
      ),
      'sort' => array(
        // ID of sort handler plugin to use.
        'id' => 'standard',
      ),
      'filter' => array(
        // ID of filter handler plugin to use.
        'id' => 'numeric',
      ),
      'argument' => array(
        // ID of argument handler plugin to use.
        'id' => 'numeric',
      ),
    );

    $data['itkdev_user_log']['deleted_user_id'] = array(
      'title' => t('User ID'),
      'help' => t('The deleted User ID'),
      'field' => array(
        'id' => 'numeric',
      ),
      'sort' => array(
        'id' => 'standard',
      ),
      'filter' => array(
        'id' => 'numeric',
      ),
      'argument' => array(
        'id' => 'numeric',
      ),
    );

    $data['itkdev_user_log']['deleted_at'] = array(
      'title' => t('Deleted At'),
      'help' => t('The user deletion date'),
      'field' => array(
        'id' => 'date',
      ),
      'sort' => array(
        'id' => 'date',
      ),
      'filter' => array(
        'id' => 'date',
      ),
    );

    $data['itkdev_user_log']['deleted_by'] = array(
      'title' => t('Deleted By'),
      'help' => t('The user ID of the deleting account'),
      'field' => array(
        'id' => 'numeric',
      ),
      'sort' => array(
        'id' => 'standard',
      ),
      'filter' => array(
        'id' => 'numeric',
      ),
      'argument' => array(
        'id' => 'numeric',
      ),
    );

    $data['itkdev_user_log']['deleted_user_name'] = array(
      'title' => t('Deleted User Name'),
      'help' => t('Name of deleted user.'),
      'field' => array(
        // ID of field handler plugin to use.
        'id' => 'standard',
      ),
      'sort' => array(
        // ID of sort handler plugin to use.
        'id' => 'standard',
      ),
      'filter' => array(
        // ID of filter handler plugin to use.
        'id' => 'string',
      ),
      'argument' => array(
        // ID of argument handler plugin to use.
        'id' => 'string',
      ),
    );

    $data['itkdev_user_log']['deleted_user_mail'] = array(
      'title' => t('Deleted User Mail'),
      'help' => t('Mail of deleted user.'),
      'field' => array(
        // ID of field handler plugin to use.
        'id' => 'standard',
      ),
      'sort' => array(
        // ID of sort handler plugin to use.
        'id' => 'standard',
      ),
      'filter' => array(
        // ID of filter handler plugin to use.
        'id' => 'string',
      ),
      'argument' => array(
        // ID of argument handler plugin to use.
        'id' => 'string',
      ),
    );

    $data['itkdev_user_log']['deleted_user'] = array(
      'title' => t('Deleted User'),
      'help' => t('The serialized deleted user'),
      'field' => array(
        'id' => 'text',
      ),
      'sort' => array(
        'id' => 'standard',
      ),
      'filter' => array(
        'id' => 'numeric',
      ),
      'argument' => array(
        'id' => 'numeric',
      ),
    );

    return $data;
  }
}
