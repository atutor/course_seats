# sql file for course seats module

#french
# module UI language
INSERT INTO `language_text` VALUES ('fr', '_module','course_seats','Sièges de cours',NOW(),'');
INSERT INTO `language_text` VALUES ('fr', '_module','seats_course_seats','Sièges de cours',NOW(),'');
INSERT INTO `language_text` VALUES ('fr', '_module','seats_howto','Sélectionnez un cours et entrez un nombre pour ajouter ou modifier le nombre maximum d’étudiants qui peuvent s’inscrire à ce cours.',NOW(),'');
INSERT INTO `language_text` VALUES ('fr', '_module','seats_max_enrolment','Nombre maximal d’inscriptions',NOW(),'');
INSERT INTO `language_text` VALUES ('fr', '_module','seats_limit','Limite de siège',NOW(),'');
INSERT INTO `language_text` VALUES ('fr', '_module','seats_howto_instructor','Entrez le nombre de places que vous souhaitez ajouter à ce cours.',NOW(),'');
INSERT INTO `language_text` VALUES ('fr', '_module','seats_used_remaining','Ce cours a utilisé %s de %s places disponibles.',NOW(),'');
INSERT INTO `language_text` VALUES ('fr', '_module','seats_add_enrolment','Sièges à ajouter :',NOW(),'');
INSERT INTO `language_text` VALUES ('fr', '_module','seats_howto_config','Si le module de paiement est installé et activé, vous pouvez autoriser les formateurs acheter davantage de sièges pour un cours et les ajouter automatiquement lorsque le paiement est reçu. Cochez la case ci-dessous et inscrire un montant pour chaque siège. Ou bien, laissez non définie à demandez à l’administrateur de ATutor gérer l’ajout de sièges de cours.',NOW(),'');
INSERT INTO `language_text` VALUES ('fr', '_module','seats_allow','Permettre aux formateurs d’acheter davantage de sièges : ',NOW(),'');
INSERT INTO `language_text` VALUES ('fr', '_module','seats_price','Prix pour chaque nouveau siège : ',NOW(),'');
INSERT INTO `language_text` VALUES ('fr', '_module','seats_config','Configuration des sièges de Cours',NOW(),'');
INSERT INTO `language_text` VALUES ('fr', '_module','seats_config_options','Configurer les Options de siège de cours ',NOW(),'');
INSERT INTO `language_text` VALUES ('fr', '_module','seats_howto_config_create','Par défaut, « Créer un cours » est désactivé pour les formateurs lorsque le module de « Sièges de cours » est installé. Vous pouvez activer la création de cours pour les formateurs et définir le nombre par défaut de places disponibles dans un cours nouvellement créé. Décochez la case « Désactiver créer des cours » puis définissez le « nombre de sièges par défaut des nouveaux cours. » ',NOW(),'');
INSERT INTO `language_text` VALUES ('fr', '_module','seats_disable_create','Désactiver créer des cours ',NOW(),'');
INSERT INTO `language_text` VALUES ('fr', '_module','seats_default_seats','Nombre de sièges par défaut pour les nouveaux cours ',NOW(),'');
INSERT INTO `language_text` VALUES ('fr', '_module','seats_payments_install','Options de configuration des sièges de cours sont définies ici lorsque le module de paiement est installé, définition d’options pour permettre aux formateurs d’acheter des sièges supplémentaires pour un cours et définit le nombre de sièges par défaut lorsque les nouveaux cours sont créés.',NOW(),'');

# module feedback
INSERT INTO `language_text` VALUES ('fr', '_msgs','AT_ERROR_DISABLE_CREATE','Ne pas définir le nombre par défaut de places disponibles dans un cours lorsque il est impossible pour les formateurs de créer des cours.',NOW(),'');
INSERT INTO `language_text` VALUES ('fr', '_msgs','AT_FEEDBACK_ENROLL_LIMIT','La limite d’inscription pour ce cours a été atteinte. Contactez l’administrateur du site pour que cette limite soit augmenté.',NOW(),'');
INSERT INTO `language_text` VALUES ('fr', '_msgs','AT_FEEDBACK_IMPORT_DISABLED','L’importation des listes de cours est désactivé. Limite de siège atteinte.',NOW(),'');
INSERT INTO `language_text` VALUES ('fr', '_msgs','AT_FEEDBACK_CREATE_LIST_DISABLED','Créer une liste de cours est désactivée. Limite de siège atteinte.',NOW(),'');
INSERT INTO `language_text` VALUES ('fr', '_msgs','AT_FEEDBACK_TAB_DISABLED','L’onglet sélectionné est désactivé.',NOW(),'');
INSERT INTO `language_text` VALUES ('fr', '_msgs','AT_ERROR_ENROLL_TOO_MANY','Trop d’êtres inscrits. Vous avez %s de sièges disponibles.',NOW(),'');
INSERT INTO `language_text` VALUES ('fr', '_msgs','AT_FEEDBACK_SEATS_UPDATED','Limite de siège de cours mis à jour pour <strong>%s</strong>.',NOW(),'');
INSERT INTO `language_text` VALUES ('fr', '_msgs','AT_FEEDBACK_SEATS_REMOVED','Limite de siège de cours supprimé pour <strong>%s</strong>.',NOW(),'');
INSERT INTO `language_text` VALUES ('fr', '_msgs','AT_ERROR_JUST_NUMBERS','Le maximum d’inscriptions doit être un nombre. Réessayez.',NOW(),'');
INSERT INTO `language_text` VALUES ('fr', '_msgs','AT_FEEDBACK_SEATS_AVAILABLE','Places disponibles pour ce cours (<strong>%s</strong>).',NOW(),'');
INSERT INTO `language_text` VALUES ('fr', '_msgs','AT_ERROR_SEATS_MUST_ENABLE_ALLOW','Vous devez cocher <strong>Autoriser les formateurs d’acheter plus de sièges</strong>',NOW(),'');
INSERT INTO `language_text` VALUES ('fr', '_msgs','AT_ERROR_SEATS_MUST_BE_NUMBER','Vous devez spécifier le nombre de sièges.',NOW(),'');
INSERT INTO `language_text` VALUES ('fr', '_msgs','AT_ERROR_NO_COURSE_SELECTED','Aucun cours sélectionné.',NOW(),'');
