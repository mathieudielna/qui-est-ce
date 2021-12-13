 /*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package controller;

import controller.exceptions.IllegalOrphanException;
import controller.exceptions.NonexistentEntityException;
import controller.exceptions.PreexistingEntityException;
import java.io.Serializable;
import javax.persistence.Query;
import javax.persistence.EntityNotFoundException;
import javax.persistence.criteria.CriteriaQuery;
import javax.persistence.criteria.Root;
import entity.Logement;
import entity.Maison;
import entity.Type;
import entity.User;
import entity.Ville;
import java.util.ArrayList;
import java.util.List;
import javax.persistence.EntityManager;
import javax.persistence.EntityManagerFactory;

/**
 *
 * @author mathieudielna
 */
public class MaisonJpaController implements Serializable {

    public MaisonJpaController(EntityManagerFactory emf) {
        this.emf = emf;
    }
    private EntityManagerFactory emf = null;

    public EntityManager getEntityManager() {
        return emf.createEntityManager();
    }

    public void create(Maison maison) throws IllegalOrphanException, PreexistingEntityException, Exception {
        List<String> illegalOrphanMessages = null;
        Logement logementOrphanCheck = maison.getLogement();
        if (logementOrphanCheck != null) {
            Maison oldMaisonOfLogement = logementOrphanCheck.getMaison();
            if (oldMaisonOfLogement != null) {
                if (illegalOrphanMessages == null) {
                    illegalOrphanMessages = new ArrayList<String>();
                }
                illegalOrphanMessages.add("The Logement " + logementOrphanCheck + " already has an item of type Maison whose logement column cannot be null. Please make another selection for the logement field.");
            }
        }
        if (illegalOrphanMessages != null) {
            throw new IllegalOrphanException(illegalOrphanMessages);
        }
        EntityManager em = null;
        try {
            em = getEntityManager();
            em.getTransaction().begin();
            Logement logement = maison.getLogement();
            if (logement != null) {
                logement = em.getReference(logement.getClass(), logement.getIdLogement());
                maison.setLogement(logement);
            }
            Type idType = maison.getIdType();
            if (idType != null) {
                idType = em.getReference(idType.getClass(), idType.getIdType());
                maison.setIdType(idType);
            }
            User idUser = maison.getIdUser();
            if (idUser != null) {
                idUser = em.getReference(idUser.getClass(), idUser.getIdUser());
                maison.setIdUser(idUser);
            }
            Ville idVille = maison.getIdVille();
            if (idVille != null) {
                idVille = em.getReference(idVille.getClass(), idVille.getIdVille());
                maison.setIdVille(idVille);
            }
            em.persist(maison);
            if (logement != null) {
                logement.setMaison(maison);
                logement = em.merge(logement);
            }
            if (idType != null) {
                idType.getMaisonCollection().add(maison);
                idType = em.merge(idType);
            }
            if (idUser != null) {
                idUser.getMaisonCollection().add(maison);
                idUser = em.merge(idUser);
            }
            if (idVille != null) {
                idVille.getMaisonCollection().add(maison);
                idVille = em.merge(idVille);
            }
            em.getTransaction().commit();
        } catch (Exception ex) {
            if (findMaison(maison.getIdLogement()) != null) {
                throw new PreexistingEntityException("Maison " + maison + " already exists.", ex);
            }
            throw ex;
        } finally {
            if (em != null) {
                em.close();
            }
        }
    }

    public void edit(Maison maison) throws IllegalOrphanException, NonexistentEntityException, Exception {
        EntityManager em = null;
        try {
            em = getEntityManager();
            em.getTransaction().begin();
            Maison persistentMaison = em.find(Maison.class, maison.getIdLogement());
            Logement logementOld = persistentMaison.getLogement();
            Logement logementNew = maison.getLogement();
            Type idTypeOld = persistentMaison.getIdType();
            Type idTypeNew = maison.getIdType();
            User idUserOld = persistentMaison.getIdUser();
            User idUserNew = maison.getIdUser();
            Ville idVilleOld = persistentMaison.getIdVille();
            Ville idVilleNew = maison.getIdVille();
            List<String> illegalOrphanMessages = null;
            if (logementNew != null && !logementNew.equals(logementOld)) {
                Maison oldMaisonOfLogement = logementNew.getMaison();
                if (oldMaisonOfLogement != null) {
                    if (illegalOrphanMessages == null) {
                        illegalOrphanMessages = new ArrayList<String>();
                    }
                    illegalOrphanMessages.add("The Logement " + logementNew + " already has an item of type Maison whose logement column cannot be null. Please make another selection for the logement field.");
                }
            }
            if (illegalOrphanMessages != null) {
                throw new IllegalOrphanException(illegalOrphanMessages);
            }
            if (logementNew != null) {
                logementNew = em.getReference(logementNew.getClass(), logementNew.getIdLogement());
                maison.setLogement(logementNew);
            }
            if (idTypeNew != null) {
                idTypeNew = em.getReference(idTypeNew.getClass(), idTypeNew.getIdType());
                maison.setIdType(idTypeNew);
            }
            if (idUserNew != null) {
                idUserNew = em.getReference(idUserNew.getClass(), idUserNew.getIdUser());
                maison.setIdUser(idUserNew);
            }
            if (idVilleNew != null) {
                idVilleNew = em.getReference(idVilleNew.getClass(), idVilleNew.getIdVille());
                maison.setIdVille(idVilleNew);
            }
            maison = em.merge(maison);
            if (logementOld != null && !logementOld.equals(logementNew)) {
                logementOld.setMaison(null);
                logementOld = em.merge(logementOld);
            }
            if (logementNew != null && !logementNew.equals(logementOld)) {
                logementNew.setMaison(maison);
                logementNew = em.merge(logementNew);
            }
            if (idTypeOld != null && !idTypeOld.equals(idTypeNew)) {
                idTypeOld.getMaisonCollection().remove(maison);
                idTypeOld = em.merge(idTypeOld);
            }
            if (idTypeNew != null && !idTypeNew.equals(idTypeOld)) {
                idTypeNew.getMaisonCollection().add(maison);
                idTypeNew = em.merge(idTypeNew);
            }
            if (idUserOld != null && !idUserOld.equals(idUserNew)) {
                idUserOld.getMaisonCollection().remove(maison);
                idUserOld = em.merge(idUserOld);
            }
            if (idUserNew != null && !idUserNew.equals(idUserOld)) {
                idUserNew.getMaisonCollection().add(maison);
                idUserNew = em.merge(idUserNew);
            }
            if (idVilleOld != null && !idVilleOld.equals(idVilleNew)) {
                idVilleOld.getMaisonCollection().remove(maison);
                idVilleOld = em.merge(idVilleOld);
            }
            if (idVilleNew != null && !idVilleNew.equals(idVilleOld)) {
                idVilleNew.getMaisonCollection().add(maison);
                idVilleNew = em.merge(idVilleNew);
            }
            em.getTransaction().commit();
        } catch (Exception ex) {
            String msg = ex.getLocalizedMessage();
            if (msg == null || msg.length() == 0) {
                Integer id = maison.getIdLogement();
                if (findMaison(id) == null) {
                    throw new NonexistentEntityException("The maison with id " + id + " no longer exists.");
                }
            }
            throw ex;
        } finally {
            if (em != null) {
                em.close();
            }
        }
    }

    public void destroy(Integer id) throws NonexistentEntityException {
        EntityManager em = null;
        try {
            em = getEntityManager();
            em.getTransaction().begin();
            Maison maison;
            try {
                maison = em.getReference(Maison.class, id);
                maison.getIdLogement();
            } catch (EntityNotFoundException enfe) {
                throw new NonexistentEntityException("The maison with id " + id + " no longer exists.", enfe);
            }
            Logement logement = maison.getLogement();
            if (logement != null) {
                logement.setMaison(null);
                logement = em.merge(logement);
            }
            Type idType = maison.getIdType();
            if (idType != null) {
                idType.getMaisonCollection().remove(maison);
                idType = em.merge(idType);
            }
            User idUser = maison.getIdUser();
            if (idUser != null) {
                idUser.getMaisonCollection().remove(maison);
                idUser = em.merge(idUser);
            }
            Ville idVille = maison.getIdVille();
            if (idVille != null) {
                idVille.getMaisonCollection().remove(maison);
                idVille = em.merge(idVille);
            }
            em.remove(maison);
            em.getTransaction().commit();
        } finally {
            if (em != null) {
                em.close();
            }
        }
    }

    public List<Maison> findMaisonEntities() {
        return findMaisonEntities(true, -1, -1);
    }

    public List<Maison> findMaisonEntities(int maxResults, int firstResult) {
        return findMaisonEntities(false, maxResults, firstResult);
    }

    private List<Maison> findMaisonEntities(boolean all, int maxResults, int firstResult) {
        EntityManager em = getEntityManager();
        try {
            CriteriaQuery cq = em.getCriteriaBuilder().createQuery();
            cq.select(cq.from(Maison.class));
            Query q = em.createQuery(cq);
            if (!all) {
                q.setMaxResults(maxResults);
                q.setFirstResult(firstResult);
            }
            return q.getResultList();
        } finally {
            em.close();
        }
    }

    public Maison findMaison(Integer id) {
        EntityManager em = getEntityManager();
        try {
            return em.find(Maison.class, id);
        } finally {
            em.close();
        }
    }

    public int getMaisonCount() {
        EntityManager em = getEntityManager();
        try {
            CriteriaQuery cq = em.getCriteriaBuilder().createQuery();
            Root<Maison> rt = cq.from(Maison.class);
            cq.select(em.getCriteriaBuilder().count(rt));
            Query q = em.createQuery(cq);
            return ((Long) q.getSingleResult()).intValue();
        } finally {
            em.close();
        }
    }
    
}
