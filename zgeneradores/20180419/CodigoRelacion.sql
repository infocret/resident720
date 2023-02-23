ALTER TABLE `persona_contactos` DROP FOREIGN KEY `persona_contactos_id_persona_foreign`;

ALTER TABLE `persona_contactos` ADD CONSTRAINT `persona_contactos_id_personas_foreign` 
FOREIGN KEY (`id_persona`) REFERENCES `personas` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
