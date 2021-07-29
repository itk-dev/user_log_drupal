<?php

namespace Drupal\itkdev_user_log\Helper;

use Drupal\Core\Entity\EntityInterface;
use Drupal\user\UserInterface;

/**
 * Helper class.
 */
class Helper {

  /**
   * Implements hook_ENTITY_TYPE_delete().
   */
  public function userDelete(EntityInterface $entity) {
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

  /**
   * Implements hook_views_data().
   */
  public function viewsData() {
    $data = [];
    $data['itkdev_user_log'] = [];
    $data['itkdev_user_log']['table'] = [];
    $data['itkdev_user_log']['table']['group'] = t('User Delete Log');
    $data['itkdev_user_log']['table']['provider'] = 'itkdev_user_log';
    $data['itkdev_user_log']['table']['base'] = [
      'field' => 'user_delete_log_id',
      'title' => t('User Delete Log'),
      'help' => t('The User Delete Log Table'),
    ];

    $data['itkdev_user_log']['user_delete_log_id'] = [
      'title' => t('User Delete Log ID'),
      'help' => t('The User Delete Log ID'),
      'field' => [
        // ID of field handler plugin to use.
        'id' => 'numeric',
      ],
      'sort' => [
        // ID of sort handler plugin to use.
        'id' => 'standard',
      ],
      'filter' => [
        // ID of filter handler plugin to use.
        'id' => 'numeric',
      ],
      'argument' => [
        // ID of argument handler plugin to use.
        'id' => 'numeric',
      ],
    ];

    $data['itkdev_user_log']['deleted_user_id'] = [
      'title' => t('User ID'),
      'help' => t('The deleted User ID'),
      'field' => [
        'id' => 'numeric',
      ],
      'sort' => [
        'id' => 'standard',
      ],
      'filter' => [
        'id' => 'numeric',
      ],
      'argument' => [
        'id' => 'numeric',
      ],
    ];

    $data['itkdev_user_log']['deleted_at'] = [
      'title' => t('Deleted At'),
      'help' => t('The user deletion date'),
      'field' => [
        'id' => 'date',
      ],
      'sort' => [
        'id' => 'date',
      ],
      'filter' => [
        'id' => 'date',
      ],
    ];

    $data['itkdev_user_log']['deleted_by'] = [
      'title' => t('Deleted By'),
      'help' => t('The user ID of the deleting account'),
      'field' => [
        'id' => 'numeric',
      ],
      'sort' => [
        'id' => 'standard',
      ],
      'filter' => [
        'id' => 'numeric',
      ],
      'argument' => [
        'id' => 'numeric',
      ],
    ];

    $data['itkdev_user_log']['deleted_user_name'] = [
      'title' => t('Deleted User Name'),
      'help' => t('Name of deleted user.'),
      'field' => [
        // ID of field handler plugin to use.
        'id' => 'standard',
      ],
      'sort' => [
        // ID of sort handler plugin to use.
        'id' => 'standard',
      ],
      'filter' => [
        // ID of filter handler plugin to use.
        'id' => 'string',
      ],
      'argument' => [
        // ID of argument handler plugin to use.
        'id' => 'string',
      ],
    ];

    $data['itkdev_user_log']['deleted_user_mail'] = [
      'title' => t('Deleted User Mail'),
      'help' => t('Mail of deleted user.'),
      'field' => [
        // ID of field handler plugin to use.
        'id' => 'standard',
      ],
      'sort' => [
        // ID of sort handler plugin to use.
        'id' => 'standard',
      ],
      'filter' => [
        // ID of filter handler plugin to use.
        'id' => 'string',
      ],
      'argument' => [
        // ID of argument handler plugin to use.
        'id' => 'string',
      ],
    ];

    $data['itkdev_user_log']['deleted_user'] = [
      'title' => t('Deleted User'),
      'help' => t('The serialized deleted user'),
      'field' => [
        'id' => 'text',
      ],
      'sort' => [
        'id' => 'standard',
      ],
      'filter' => [
        'id' => 'numeric',
      ],
      'argument' => [
        'id' => 'numeric',
      ],
    ];

    return $data;
  }

}
