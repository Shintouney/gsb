<h1>Mes tickets</h1>

<table class='incident'>
    <thead>
    <td> </td>
    <td>Id</td>
    <td>Etat</td>
    <td>Materiel</td>
    <td>Objet de<br/>l'incident</td>
    <td>Date de<br/>signalement /<br/>intervention</td>
    <td>Salle</td>

    <?php //champs supplémentaires pour responsables + techniciens
    if ($this->getUser()->is(array('ROLE_TECHNICIEN', 'ROLE_RESPONSABLE', 'ROLE_ADMIN')))
    {
        ?>
        <td>Technicien</td>
        <td>Demandeur</td>
        <td>Niveau<br/>d'urgence/<br/>
            complexité</td>
    <?php
    }
    ?>
    </thead>


    <tbody>
    <?php //seulement les tickets du demandeur if id=getid
    foreach($tickets as $ligne_ticket)
    {
        ?>
        <tr >
        <td> <a href='?app=incident&action=afficher_ticket&id=<?=$ligne_ticket['id'];?>' >Voir plus</a></td>
        <td> <?php echo $ligne_ticket['id'];?> </td>
        <td> <?php echo $ligne_ticket['intitule_etat'];?> </td>
        <td> <?php echo $ligne_ticket['num_inventaire'] . ' - <br/>'
                . $ligne_ticket['type_materiel'] . ' - <br/>'
                . $ligne_ticket['marque_materiel'] . ' - <br/>'
                . $ligne_ticket['modele_materiel'];?> </td>
        <td> <?php echo $ligne_ticket['objet_incident'];?> </td>
        <td> <?php echo $ligne_ticket['date_signalement']. ' / <br/>'
                . $ligne_ticket['date_intervention'];?> </td>
        <td> <?php echo $ligne_ticket['salle_nom'] ;?></td>

        <?php //champs supplémentaires pour responsables + techniciens
        if ($this->getUser()->is(array('ROLE_TECHNICIEN', 'ROLE_RESPONSABLE', 'ROLE_ADMIN')))
        {
            ?>
            <td><?php echo $ligne_ticket['pnom_tech'] . ' ' . $ligne_ticket['nom_tech'];?></td>
            <td><?php echo $ligne_ticket['pnom_demand'] . ' ' . $ligne_ticket['nom_demand'];?></td>
            <td><?php echo $ligne_ticket['niveau_urgence'] . ' / '
                    . $ligne_ticket['niveau_complexite'];?></td>
            </tr>
        <?php
        }
        ?>
        </tr>
    <?php
    }
    ?>
    </tbody>
</table>